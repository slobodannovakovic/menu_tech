<h1>Order Details:</h1>

<p>Cost in USD: {{ $order->base_currency_amount }}</p>

<p>Purchesed currency: {{ $order->currency_label }}</p>

<p>Purchesed currency amount: {{ $order->currency_amount }}</p>

<p>Exchange rate: {{ $order->exchange_rate }}</p>

<p>Discount percentage: {{ $order->discount_percentage }}</p>

<p>Discount amount: {{ $order->discount_amount }}</p>

<p>Surcharge percentage: {{ $order->surcharge_percentage }}</p>

<p>Surcharge amount: {{ $order->surcharge_amount }}</p>

<p>Created at: {{ $order->created_at->format('d.m.Y h:i:s') }}</p>