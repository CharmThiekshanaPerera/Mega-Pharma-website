<!-- ============ ASSISTANT — rule-based, no external API (see ChatbotService) ============ -->
<div id="chatWidget" class="chat-widget">
  <button id="chatToggle" class="chat-toggle" type="button" aria-expanded="false" aria-controls="chatPanel" aria-label="Open chat assistant">
    <svg class="chat-toggle-icon-open" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H8l-5 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><circle cx="8" cy="10.5" r=".9" fill="currentColor" stroke="none"/><circle cx="12" cy="10.5" r=".9" fill="currentColor" stroke="none"/><circle cx="16" cy="10.5" r=".9" fill="currentColor" stroke="none"/></svg>
    <svg class="chat-toggle-icon-close" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>
  </button>

  <div id="chatPanel" class="chat-panel" role="dialog" aria-modal="false" aria-label="Mega Pharma assistant" hidden>
    <div class="chat-panel-head">
      <div>
        <strong>Mega Pharma Assistant</strong>
        <span>Answers from our own catalogue &amp; site info</span>
      </div>
      <button id="chatClose" type="button" class="chat-close" aria-label="Close chat">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>
      </button>
    </div>

    <div id="chatMessages" class="chat-messages" role="log" aria-live="polite" aria-label="Conversation">
      <div class="chat-msg chat-msg--bot">
        <p>Hello — I can answer questions about our products, the Group, or how to get in touch. Try asking something like &ldquo;do you have a blood pressure monitor&rdquo; or &ldquo;where are you located&rdquo;.</p>
      </div>
    </div>

    <form id="chatForm" class="chat-form" autocomplete="off">
      <input id="chatInput" type="text" name="message" maxlength="500" placeholder="Ask a question…" aria-label="Your message" required>
      <button type="submit" aria-label="Send">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
      </button>
    </form>
  </div>
</div>

<script>
(function(){
  "use strict";
  const widget = document.getElementById("chatWidget");
  if (!widget) return;
  const toggle = document.getElementById("chatToggle");
  const panel = document.getElementById("chatPanel");
  const closeBtn = document.getElementById("chatClose");
  const messages = document.getElementById("chatMessages");
  const form = document.getElementById("chatForm");
  const input = document.getElementById("chatInput");
  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || "";
  let open = false;

  function setOpen(next){
    open = next;
    panel.hidden = !open;
    widget.classList.toggle("open", open);
    toggle.setAttribute("aria-expanded", String(open));
    toggle.setAttribute("aria-label", open ? "Close chat assistant" : "Open chat assistant");
    if (open) setTimeout(() => input.focus(), 50);
  }
  toggle.addEventListener("click", () => setOpen(!open));
  closeBtn.addEventListener("click", () => setOpen(false));
  document.addEventListener("keydown", e => { if (e.key === "Escape" && open) setOpen(false); });

  function scrollToEnd(){ messages.scrollTop = messages.scrollHeight; }

  function addMessage(html, who){
    const el = document.createElement("div");
    el.className = "chat-msg chat-msg--" + who;
    el.innerHTML = html;
    messages.appendChild(el);
    scrollToEnd();
    return el;
  }

  function escapeHtml(s){
    return s.replace(/[&<>"']/g, c => ({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"}[c]));
  }

  function renderBotReply(data){
    let html = "<p>" + escapeHtml(data.reply) + "</p>";
    if (Array.isArray(data.products) && data.products.length){
      html += '<div class="chat-products">' + data.products.map(p =>
        '<a class="chat-product" href="' + p.url + '">' +
          '<span class="chat-product-name">' + escapeHtml(p.name) + '</span>' +
          '<span class="chat-product-meta">' + escapeHtml(p.generic) + ' · ' + escapeHtml(p.manufacturer) + '</span>' +
        '</a>'
      ).join("") + '</div>';
    }
    addMessage(html, "bot");
  }

  let sending = false;
  form.addEventListener("submit", async e => {
    e.preventDefault();
    const text = input.value.trim();
    if (!text || sending) return;
    sending = true;
    addMessage("<p>" + escapeHtml(text) + "</p>", "user");
    input.value = "";
    const typing = addMessage('<p class="chat-typing"><i></i><i></i><i></i></p>', "bot");

    try {
      const res = await fetch("{{ route('chat.respond') }}", {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": csrf, "Accept": "application/json" },
        body: JSON.stringify({ message: text }),
      });
      typing.remove();
      if (!res.ok) throw new Error("bad response");
      renderBotReply(await res.json());
    } catch (err) {
      typing.remove();
      addMessage("<p>Sorry — something went wrong reaching the assistant. Please try again, or use the contact form below.</p>", "bot");
    } finally {
      sending = false;
      input.focus();
    }
  });
})();
</script>
