@component('mail::message')
# New website enquiry

A visitor submitted the contact form on the Mega Pharma Group website.

**Name:** {{ $inquiry->name }}
**Email:** {{ $inquiry->email }}
**Topic:** {{ $inquiry->topic }}

**Message:**

{{ $inquiry->message }}

@component('mail::button', ['url' => 'mailto:'.$inquiry->email])
Reply to {{ $inquiry->name }}
@endcomponent

Submitted {{ $inquiry->created_at->format('d M Y, H:i') }} from {{ $inquiry->ip_address }}.

This enquiry is also stored in the admin panel under Messages.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
