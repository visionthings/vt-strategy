@extends('layout.layout')
@section('title','الدفع')
  <!-- Other Tags -->

  <!-- Moyasar Styles -->
  <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.12.0/moyasar.css" />

  <!-- Moyasar Scripts -->
  <script src="https://cdn.moyasar.com/mpf/1.12.0/moyasar.js"></script>

  <!-- Download CSS and JS files in case you want to test it locally, but use CDN in production -->


<style>
.payment-container{
    width: 100%;
    height: 100%;
    padding-top: 150px;
}
.payment-container .payment-content {
    width: 100%;
    height: 100%;
}
.payment-container .payment-content .payment-form{
    width: 80%;
    height: 100%;
    margin: auto;
}
</style>
@section('content')
<div class="payment-container">

    <div class="payment-content">
        <div class="payment-form">
          <h4>
            @if(Session::get('success'))
              <div class="alert alert-success">
                {{Session::get('success')}} 
              </div>
            @endif
            @if(Session::get('paidFaild'))
              <div class="alert alert-danger">
                {{Session::get('paidFaild')}} 
              </div>
            @endif
            
          </h4>
          <div class="mysr-form"></div>
      
        </div>
      
    </div>
</div>

<script>
  var id ="{{$consultation_id}}";
  Moyasar.init({
    element: '.mysr-form',
    amount: "{{$price*10}}",
    currency: 'SAR',
    description: '{{$consultion->name}}',
    publishable_api_key: "{{env('MOYASAR_API_PUBLISHABLE_KEY')}}",
    callback_url: '{{url('payment-callback')}}/' + id,
    supported_networks: [ 'mada'],
    methods: ['creditcard','stcpay'],
  })
</script>

@endsection
