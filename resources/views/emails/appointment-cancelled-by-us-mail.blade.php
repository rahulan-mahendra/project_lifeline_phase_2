<x-mail::message>
Hi  there,

Appointment Reference: {{$content['appointment_code']}}

Hope this email finds you well. You have scheduled an appointment to see our GP on {{$content['appointment_date']}} at {{$content['appointment_time']}}.
We regret to inform you that the appointment needs to be cancelled or rescheduled due to an unexpected unavailability of the GP. Please contact us via phone call or email to book in with us for another time that is of your convenience.
Please quote your reference number when contacting. We apologise for any inconvenience caused and thank you for the understanding.

Please contact us on {{$content['from']}} for further information.

Best Regards,<br>
Lifeline Healthcare Group - {{$content['clinic_name']}}
</x-mail::message>
