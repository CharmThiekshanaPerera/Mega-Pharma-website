<?php

/*
 | The 15 therapeutic / device collections, keyed by URL slug. `name` must
 | match Product::category exactly — it is how a collection page finds its
 | products. Copy here describes the *range* only (what kinds of products a
 | collection spans); anything product-specific comes from the product
 | records themselves, so nothing on these pages makes a claim the catalogue
 | doesn't.
 */
return [

    // ───────────── Mega Pharma — pharmaceuticals ─────────────
    'cardiology' => [
        'name' => 'Cardiology',
        'company' => 'pharma',
        'tagline' => 'Heart and blood-pressure therapy across the treatment ladder.',
        'intro' => 'Our cardiology range spans the core of cardiovascular prescribing — blood-pressure control, lipid management, antiplatelet and anticoagulant therapy, and rhythm control — sourced from established Indian principals and promoted ethically to the profession.',
        'covers' => ['Antihypertensives: calcium-channel blockers, ARBs and combinations', 'Lipid-lowering statins and fibrates', 'Antiplatelet and direct oral anticoagulant options', 'Anti-arrhythmic and alpha-blocker therapy'],
    ],
    'diabetology' => [
        'name' => 'Diabetology',
        'company' => 'pharma',
        'tagline' => 'Glycaemic-control options from first-line to modern add-ons.',
        'intro' => 'From long-established agents to newer classes, the diabetology collection supports prescribers managing type 2 diabetes across its stages, alongside supportive therapies commonly used in the same patients.',
        'covers' => ['Biguanide and sulfonylurea therapy', 'DPP-4 and SGLT2 inhibitors', 'Thiazolidinedione and alpha-glucosidase options', 'Supportive gastro and neuropathic-pain medicines'],
    ],
    'dermatology' => [
        'name' => 'Dermatology',
        'company' => 'pharma',
        'tagline' => 'Our largest pharmaceutical range — skin, hair and nail care.',
        'intro' => 'Dermatology is the broadest collection in the Mega Pharma house: topical and oral therapy for acne, fungal and bacterial infections, inflammatory and pigmentary conditions, hair loss and allergy — in the forms dermatologists actually prescribe.',
        'covers' => ['Acne: topical antibiotics, retinoids, benzoyl peroxide, azelaic acid', 'Antifungal, antiviral and antibacterial topicals', 'Corticosteroids from mild to super-potent', 'Hair-loss therapy and antihistamines'],
    ],
    'neuropsychiatry' => [
        'name' => 'Neuropsychiatry',
        'company' => 'pharma',
        'tagline' => 'Mood, psychosis and neuropathic-pain therapy.',
        'intro' => 'A focused range for psychiatrists and neurologists — antidepressants, antipsychotics and neuropathic-pain therapy — supplied to the profession with the care that prescription-only medicines demand.',
        'covers' => ['SSRIs and other antidepressants', 'Atypical antipsychotics', 'Neuropathic-pain and anxiety therapy'],
    ],
    'ayurvedic' => [
        'name' => 'Ayurvedic',
        'company' => 'pharma',
        'tagline' => 'Himalaya herbal formulations, distributed across Sri Lanka.',
        'intro' => 'Mega Pharma distributes the Himalaya range of herbal formulations — long-established brands for liver, urinary, joint, digestive, respiratory, women\'s and men\'s wellness, immune support and more.',
        'covers' => ['Liver, digestive and gastric care', 'Urinary, prostate and ano-rectal care', 'Joint, bone and cardiac wellness', 'Women\'s and men\'s wellness, immune and neuro support'],
    ],
    'urology' => [
        'name' => 'Urology',
        'company' => 'pharma',
        'tagline' => 'Targeted therapy for urological and sexual-health conditions.',
        'intro' => 'A compact urology collection covering overactive bladder and erectile dysfunction, sourced from Acme Formulations.',
        'covers' => ['Antimuscarinic therapy for overactive bladder', 'PDE5-inhibitor therapy for erectile dysfunction'],
    ],
    'nutrition-wellness' => [
        'name' => 'Nutrition & Wellness',
        'company' => 'pharma',
        'tagline' => 'Everyday supplementation that supports recovery and general health.',
        'intro' => 'Multivitamins, vitamin D and dietary-fibre support for the everyday nutritional needs that sit alongside prescription care.',
        'covers' => ['Multivitamin and mineral supplementation', 'Vitamin D3 supplementation', 'Dietary-fibre support'],
    ],

    // ───────────── Mega Meditech — medical technology ─────────────
    'diagnostics-monitoring' => [
        'name' => 'Diagnostics & Monitoring',
        'company' => 'meditech',
        'tagline' => 'Measure it accurately — at the clinic or at home.',
        'intro' => 'Blood-pressure monitors, glucose meters and continuous glucose monitoring, and clinical thermometers from TaiDoc, YuWell and B.Well Swiss — devices for clinics, pharmacies and patients managing chronic conditions at home.',
        'covers' => ['Automatic and aneroid blood-pressure monitors', 'Blood-glucose meters, lancets and CGM systems', 'Digital clinical thermometers'],
    ],
    'respiratory-care' => [
        'name' => 'Respiratory Care',
        'company' => 'meditech',
        'tagline' => 'Nebulisers and oxygen therapy for home and clinic.',
        'intro' => 'Compressor nebulisers for adults and children, and home oxygen concentrators — respiratory devices from B.Well Swiss and Yasee QY Medical.',
        'covers' => ['Compressor nebulisers, including a child-friendly model', 'Home oxygen concentrators with filters and masks'],
    ],
    'wound-care' => [
        'name' => 'Wound Care',
        'company' => 'meditech',
        'tagline' => 'Advanced dressings and negative-pressure therapy.',
        'intro' => 'Complex and non-healing wounds call for more than a plain dressing. This collection spans negative-pressure wound therapy systems and consumables, collagen dressings and fillers, and topical skin adhesive.',
        'covers' => ['Negative-pressure wound therapy pumps, canisters, foam and connectors', 'Collagen sheets and particle fillers', 'Topical skin adhesive'],
    ],
    'surgical-burn-care' => [
        'name' => 'Surgical & Burn Care',
        'company' => 'meditech',
        'tagline' => 'Skin-grafting systems and organ-preservation solutions.',
        'intro' => 'Specialist equipment for burn and plastic surgery teams — micrografting systems, dermatomes and mesh carriers from Humeca — together with Dr. F. Köhler Chemie\'s Custodiol organ-preservation solution.',
        'covers' => ['MEEK micrografting sets, gauzes and adhesive', 'Battery-powered dermatomes and blades', 'Skin-graft mesh carriers', 'Organ preservation and cardioplegia solution'],
    ],
    'orthopaedic-care' => [
        'name' => 'Orthopaedic Care',
        'company' => 'meditech',
        'tagline' => 'Supports, braces and splints from Tynor.',
        'intro' => 'The Tynor orthopaedic range — spinal, cervical, limb and joint supports, immobilisation splints and compression stockings — for post-injury, post-operative and chronic-condition care.',
        'covers' => ['Lumbosacral, thoraco-lumbar and cervical supports', 'Knee, wrist, arm and ankle-foot orthoses', 'Walker boots and traction kits', 'Medical compression stockings'],
    ],
    'womens-health' => [
        'name' => 'Women\'s Health',
        'company' => 'meditech',
        'tagline' => 'Gynaecological diagnostic devices.',
        'intro' => 'A specialist gynaecology device from MedGyn — an endometrial sampling pipette — for clinicians performing endometrial assessment.',
        'covers' => ['Endometrial sampling devices'],
    ],
    'physiotherapy' => [
        'name' => 'Physiotherapy',
        'company' => 'meditech',
        'tagline' => 'Quantum Molecular Resonance therapy.',
        'intro' => 'Telea\'s Q-Physio Quantum Molecular Resonance system — an Italian-made physical-therapy device for clinics and rehabilitation practices.',
        'covers' => ['Quantum Molecular Resonance therapy systems'],
    ],
    'home-wellness' => [
        'name' => 'Home Wellness',
        'company' => 'meditech',
        'tagline' => 'Relaxation and recovery at home.',
        'intro' => 'B.Well Swiss shiatsu massagers designed for neck, back, shoulders and legs — everyday comfort devices for the home.',
        'covers' => ['Shiatsu cushion massager', 'Shiatsu and tapping neck massager'],
    ],
];
