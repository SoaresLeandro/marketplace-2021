@extends('layouts.front')

@section('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')

    <div class="container">
        <div class="col-sm-6">

            <div class="row">
                <div class="col-sm-12">
                    <h2>Dados para pagamento</h2>
                    <hr>
                </div>
            </div>

            <form action="">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="card_name">Nome no Cartão</label>
                        <input type="text" name="card_name" id="card_name" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="card_number">Número do Cartão</label>
                        <input type="text" name="card_number" id="card_number" class="form-control">
                        <input type="hidden" name="card_brand">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="card_month">Mês</label>
                        <input type="number" min="1" max="12" value="1" name="card_month" id="card_month" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <label for="card_year">Ano</label>
                        <input type="text" name="card_year" id="card_year" class="form-control">
                    </div>
                    
                    <div class="col-sm-2 ml-auto">
                        <label for="card_cvv">CVV</label>
                        <input type="text" name="card_cvv" id="card_cvv" class="form-control">
                    </div>  
                </div>

                <div class="form-group installments">

                </div>                

                <div class="row mb-2">
                    <div class="col-sm-3">
                        <span class="brand"></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg processPayment">Efetuar Pagamento</button>
            </form>

        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>

        const sessionId = '{{ session()->get('pagseguro_session_code') }}';

        PagSeguroDirectPayment.setSessionId(sessionId);

    </script>

    <script>

        let amountTransaction = {{ $cartItems }}
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');

        cardNumber.addEventListener('keyup', () => {
            
            if ((cardNumber.value.length >= 6) ) {
                
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: (res) => {
                        let flagImg = `https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png`;
                        spanBrand.innerHTML = `<img src="${flagImg}">`;

                        document.querySelector('input[name=card_brand]').value = res.brand.name;

                        getInstallments(amountTransaction, res.brand.name);
                    },
                    error: (err) => {
                        
                    },
                    complete: (res) => {

                    }

                });

            }

        });

        let submitButton = document.querySelector('button.processPayment');

        submitButton.addEventListener('click', (event) => {

            event.preventDefault();

            PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=card_number]').value,
                brand: document.querySelector('input[name=card_brand]').value,
                cvv: document.querySelector('input[name=card_cvv]').value,
                expirationMonth: document.querySelector('input[name=card_month]').value,
                expirationYear: document.querySelector('input[name=card_year]').value,
                success: (res) => {
                    proccessPayment(res.card.token);                    
                }
            });

        });

        function proccessPayment(token)
        {   
            let data = {
                card_token: token,
                hash: PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('select.select_installments').value,
                card_name: document.querySelector('input[name=card_name]').value,
                _token: '{{ csrf_token() }}'
            };
            
            $.ajax({
                type: 'post',
                url: '{{ route("checkout.proccess") }}',
                data: data,
                data_type: 'json',
                success: (res) => {
                    toastr.success(res.data.message, 'Successo')

                    window.location.href = '{{ route("checkout.thanks") }}?order=' + res.data.order;
                }
            });
        }

        function getInstallments(amount, brand) 
        {
            PagSeguroDirectPayment.getInstallments({                
                amount: amount,
                brand: brand,
                maxInstallmentNoInteres: 0,
                success: (res) => {
                    let selectInstallments = drawSelectInstallments(res.installments[brand]);
                    document.querySelector('div.installments').innerHTML = selectInstallments;
                },
                error: (err) => {
                    
                },
                complete: (res) => {
                    
                }
            });
        }

        function drawSelectInstallments(installments) 
        {
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class="form-control select_installments">';

            for(let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total: R$ ${l.totalAmount}</option>`;
            }

            select += '</select>';

            return select;
        }
    
    </script>
@endsection