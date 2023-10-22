<x-mail::message>
Hi  there,

Appointment Reference: {{$content['appointment_code']}}

Hope this email finds you well. We have received your request to cancel the appointment for  {{$content['appointment_date']}} at {{$content['appointment_time']}}.
Hereby we confirm you that the appointment is cancelled. Please contact us via phone call or email to book an appointment for future dates.

We thank you for choosing us as your preferred healthcare provider.

Please contact us on {{$content['from']}} for further information.

Best Regards,<br>
Lifeline Healthcare Group - {{$content['clinic_name']}}
</x-mail::message>
