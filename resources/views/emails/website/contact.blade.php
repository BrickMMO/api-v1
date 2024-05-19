<x-mail::message>
# Website Contact Form

The following person has filled out the website contact form:

Name: {{ $name }}  
Email: {{ $email }}

{{ $comments }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
