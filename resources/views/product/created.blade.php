<x-mail::message>
# example App

A new Product {{ $product->name }} has ben created successfully by {{ $user->name }}

<x-mail::button :url="''">
Visit product
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
