@component('mail::message')
# Takeaway Order

Hello again!<br>

Thank you for your payment for order {{ $id }}. 

Payment ref is {{ $cardPaymentRef }}.


@component('mail::button', ['url' => $url])
Bengal Tiger menu
@endcomponent

Thanks,<br>
Bengal Tiger
@endcomponent