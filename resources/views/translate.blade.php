<h1>Translate</h1>

<p>{{ trans('product.name') }}</p>
<p>{{ trans('product.address') }}</p>
<p>{{ trans('product.age') }}</p>



<form action="{{ route('change-language') }}" method="POST">
    @csrf
    <select name="language" onchange="this.form.submit()">
        <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}>English</option>
        <option value="ar" {{ session('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>
        <!-- يمكنك إضافة المزيد من الخيارات للغات الأخرى -->
    </select>
</form>

{{-- Print session value for debugging --}}
<p>Session Value: {{ session('locale') }}</p>
