<x-mail::message>
Hi there,

Your are receiving this email because we received a password reset request for your account.

<x-mail::button :url="$content['url']">
Reset Password
</x-mail::button>

This password rest link will expire in 60 minutes.

If you did not requiest a password reset, not further action is required.

Best Regards,<br>
Lifeline Healthcare Group
</x-mail::message>
