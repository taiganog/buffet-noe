<!DOCTYPE html>
<!-- Props: data, evento(cliente, valor etc), complementos(key => value) -->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        @vite(['resources/css/app.css'])
    <body class="font-sans antialiased px-10">
        <!-- Header -->
        <div class="flex justify-center">
            <h1 class="text-2xl font-bold">Buffet Arca de Noé</h1>
        </div>
        <!-- Conteúdo -->
        <div class="text-[10px]">
            <div class="flex justify-between p-2">
                <!-- Horário e local -->
                <span>Águas Lindas, {{ $data->day }} de {{ $data->format('M') }} de {{ $data->year }}</span>
                <span>Telefone: (61) 99117-2712</span>
            </div>

            <hr class="w-11/12 m-auto border-black pb-2" />
            <!-- Descrição -->
            <div class="px-5">
                <p class="font-bold">O Buffet Arca de Noé agradece a confiança e apresenta a seguinte proposta de serviços para atender:</p>
                <div class="grid grid-cols-2 mt-1">
                    <p><b>Nome do evento:</b> {{ $evento->tipo }} - {{ $evento->cliente->nome }}</p>
                    <p><b>Quantidade de convidados:</b> {{ $evento->numero_convidados }}</p>
                    <p><b>Data do evento:</b> {{ $evento->data }}</p>
                    <p><b>Local do evento:</b> {{ $evento->local }}</p>
                </div>
                <!-- Cardápio -->
                <div class="mt-1">
                    <p><b>Entradas:</b> {{ $evento->complemento->entradas }}</p>
                    <p><b>Cardápio:</b> {{ $evento->complemento->cardapio }}</p>
                </div>
                <!-- Tabela -->
                <div class="mt-3">
                    <h2 class="text-center text-xl font-bold">Contrato</h2>
                    <div class="flex justify-center">
                        <table class="">
                            <thead>
                                <tr class="bg-yellow-200">
                                    <th class="border border-black p-2">SERVIÇO</th>
                                    <th class="border border-black p-2">QTD</th>
                                    <th class="border border-black p-2">VALOR UNITÁRIO</th>
                                    <th class="border border-black p-2">VALOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Tabela de itens -->
                                @foreach ($complementos as $chave => $valor)
                                    @if($evento->complemento->$chave > 0)
                                        <tr class="text-center">
                                            <!-- Nome do complemento -->
                                            <td class="text-left border border-black">{{ $valor }}</td>
                                            <!-- Quantidade -->
                                            <td class="border border-black">{{ $evento->complemento->$chave }}</td>
                                            <!-- Valor unitário -->
                                            <td class="border border-black">R${{ $evento->valor->$chave / $evento->complemento->$chave }},00</td>
                                            <!-- Valor total -->
                                            <td class="border border-black px-10">R${{ $evento->valor->$chave }},00</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <!-- Informação de descontos -->
                                <tr class="text-center">
                                    <td></td>
                                    <td></td>
                                    <td class="font-bold border border-black">Descontos: </td>
                                    <td class="font-bold border border-black">R$0,00</td></td>
                                </tr>
                                <!-- Informação total -->
                                <tr class="text-center">
                                    <td></td>
                                    <td></td>
                                    <td class="font-bold border border-black">Total: </td>
                                    <td class="font-bold border border-black">R${{ $evento->valor->total }},00</td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Observações -->
            <div class="px-5 text-[10px] font-bold">
                <h2 class="text-center text-xl font-bold p-4">Observação</h2>
                <p>É de toda responsabilidade do cliente todos os itens locados. Sendo assim no caso de quebras ou pedidos será cobrado R$15,00/und (taça, garfo, faca e cestinhas) e pratos R$25,00/und.</p>
                <p>Fica ciente que o pagamento total deverá ser feito até 10 dias antes do evento.</p>
                <p>Fica ciente que exceder quantidade de convidados combinado em contrato será cobrado o valor de 30 reais por pessoa.</p>
                <p>Fica ciente que deverá contar em sua lista de convidados crianças a partir de 5 anos .</p>
                <p>O adiamento do evento totalizando mais de UM ANO sofrerá atualização para os valores atuais de acordo com a data adiada.</p>
                <p>Ocorrendo a desistência por parte do Cliente, o valor pago à Empresa não será restituído, em caso inverso, a Empresa se obriga a devolver a quantia total recebida.</p>
                <p>Fica acordado que o cliente tem por obrigação de trazer os ingredientes solicitados conforme a lista fornecida pelo responsável do buffet, caso não seja traga conforme o solicitado, o buffet não se responsabilizará pela qualidade e quantidade do cardápio proposto no contrato.</p>
                <p>Fica ciente a 6 Meses antes do Evento ocorrera a atualização de valores ao preço acima citado com os preços do ano atual do evento.</p>
                <p>A Empresa por força de Lei, não atenderá bebida alcoólica a menor de idade, caso ocorra o consumo, não será de responsabilidade da Empresa, qualquer fato/incidentes que ocorram com eles.</p>

                <div class="flex justify-between pt-2">
                    <p><b>Dados Bancários:</b> Banco Itaú, agência 4414, Conta Poupança 27786-5/500 ou Pix 61991172712.</p>
                    <p><b>Empresa Contratada:</b> Buffet Arca de Noé</p>
                </div>
            </div>
            <div class="px-5">
                <p><b>Contato do cliente:</b> {{ $evento->cliente->telefone }}</p>
                <p><b>Endereço do cliente:</b> {{ $evento->cliente->endereco }}</p>
            </div>

            <!-- Área de Assinatura -->
            <div class="grid grid-cols-2 p-5 justify-center text-center">
                <hr class="w-1/2 m-auto border-black" />
                <hr class="w-1/2 m-auto border-black" />

                <span>Noeberson Silva da Cruz</span>
                <span>{{  $evento->cliente->nome }}</span>

                <span>CNPJ: 00.000.000/0000-00</span>
                <span>CPF: {{ $evento->cliente->cpf }}</span>
            </div>
        </div>
    </body>
</html>
