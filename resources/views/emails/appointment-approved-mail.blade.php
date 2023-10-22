<x-mail::message>
Hi  there,

Appointment Reference: {{$content['appointment_code']}}

Hope this email finds you well. This is to confirm your booking with Lifeline Healthcare Group. Your appointment is scheduled for {{$content['appointment_date']}} at {{$content['appointment_time']}}.
Please feel free to contact us via phone call or email if you would like to reschedule or to cancel your appointment. Please don't forget to include above mentioned reference number.

We thank you for choosing us as your preferred healthcare provider.

Please contact us on {{$content['from']}} for further information.

Best Regards,<br>
Lifeline Healthcare Group - {{$content['clinic_name']}}
</x-mail::message>
