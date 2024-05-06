
<h3 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight py-2">
    {{ __('Ações em massa') }}
</h3>
<div class='confirm-delete popup'>
<h3 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight py-2">
    {{ __('Tem certeza que quer deletar o/os usuários selecionados?') }}
</h3>
<div class='buttons'>
<button class="yesDelete">Sim</button>
<button class='noDelete'>Não</button>
</div>
</div>
<div class='bulk-actions bg-white dark:bg-gray-800 border-b border-gray-300 dark:border-gray-700'>
    <div class='select-all'>
        <button class='bulk-action select'>
            Selecionar
        </button>
    </div>
    @if($route == 'dashboard')
    <div class='apply-all'>
        <button class='bulk-action update'>
            Atualizar
        </button>
    </div>
    <div class='delet-selected'>
        <button class='bulk-action delete'>
            Deletar
        </button>
    </div>
    @else
    <div class='apply-all'>
        <button class='bulk-action exportCsv'>
            Exportar Csv
        </button>
    </div>
    <div class='apply-all'>
        <button class='bulk-action update'>
            Enviar Email
        </button>
    </div>
    @endif
</div>
<div class='table'>
    <div class='header'>
        <div class='space'>

        </div>
        <div class='content'>
            <div class='column'>
                Nome
            </div>
            <div class='column'>
                CPF
            </div>
            <div class='column'>
                Valor
            </div>
        </div>
        <div class='actions'>
            Ações
        </div>
    </div>
    @foreach($clients as $client)
    <div class='row'>
        <div class='header'>
            <div class='bulk-select'>
                <input type='checkbox' class='row-selector'>
            </div>
            <input class='client-id' value='{{ $client->client_id }}' hidden>
            <div class='content'>
                <div class='client-name column'>
                    <input class='rowHeadInput client-name' type='text' readonly='true' value='{{ $client->name }}'>
                </div>
                <div class='client-document column'>
                    {{ $client->document }}
                </div>
                <div class='client-value column'>
                    <span class='prefix'>R$</span>
                    <input class='rowHeadInput client-value' type='number' readonly='true' min='0' step='0.01' value='{{ number_format($client->value, 2, ".", ",") }}'>
                </div>
            </div>
            <div class='actions'>
                @if($route == 'dashboard')
                <button class='rowMoreContent'><span class='text'>Mais</span><span class='svg'>
                        <?php
                        echo file_get_contents(public_path("icons") . "/arrow.svg");
                        ?>
                    </span>
                </button>
                <button class='rowEditContent'><span class='text'>Editar</span><span class='svg'>
                        <?php
                        echo file_get_contents(public_path("icons") . "/editar.svg");
                        ?>
                    </span>
                </button>
                <button class='rowDelete'><span class='text'>Deletar</span>
                    <span class='svg'>
                        <?php
                        echo file_get_contents(public_path("icons") . "/x.svg");
                        ?>
                    </span>
                </button>
                @else
                <button class='rowMoreContent'><span class='text'>Mais</span><span class='svg'>
                        <?php
                        echo file_get_contents(public_path("icons") . "/arrow.svg");
                        ?>
                    </span>
                </button>
                <button class='rowCsvExport'><span class='text'>CSV</span><span class='svg'>
                        <?php
                        echo file_get_contents(public_path("icons") . "/csv.svg");
                        ?>
                    </span>
                </button>
                <button class='rowEmailSend'><span class='text'>Email</span>
                    <span class='svg'>
                        <?php
                        echo file_get_contents(public_path("icons") . "/email.svg");
                        ?>
                    </span>
                </button>
                @endif
            </div>
        </div>
        <div class='body'>
            <div class='row'>
                <div class='key'>
                    Nível ID
                </div>
                <div class='value'>
                    <span class='prefix'></span>
                    <input class='rowBodyInput client-stage_id' type='number' min='0' step='1' readonly='true' value='{{ $client->stage_id }}'>
                </div>
            </div>
            <div class='row'>
                <div class='key'>
                    Desconto
                </div>
                <div class='value'>
                    <span class='prefix'>R$</span>
                    <input class='rowBodyInput client-discount_value' type='number' type='number' readonly='true' placeholder='0,00' min='0' step='0.01' value='{{ number_format($client->discount_value, 2, ".", ",") }}'>
                </div>
            </div>
            <div class='row'>
                <div class='key'>
                    Valor Líquido
                </div>
                <div class='value'>
                    <span class='prefix'>R$</span>
                    <input class='rowBodyInput client-net_value' type='number' readonly='true' placeholder='0,00' min='0' step='0.01' value='{{ number_format($client->net_value, 2, ".", ",") }}'>
                </div>
            </div>
            <div class='row'>
                <div class='key'>
                    Valor Bruto
                </div>
                <div class='value'>
                    <span class='prefix'>R$</span>
                    <input class='rowBodyInput client-gross_value' type='number' readonly='true' placeholder='0,00' min='0' step='0.01' value='{{ number_format($client->gross_value, 2, ".", ",") }}'>
                </div>
            </div>
            <div class='row'>
                <div class='key'>
                    Crédito
                </div>
                <div class='value'>
                    <span class='prefix'>R$</span>
                    <input class='rowBodyInput client-credit_value' type='number' readonly='true' placeholder='0,00' min='0' step='0.01' value='{{ number_format($client->credit_value, 2, ".", ",") }}'>
                </div>
            </div>
            <div class='row'>
                <div class='key'>
                    Valor Extra
                </div>
                <div class='value'>
                    <span class='prefix'>R$</span>
                    <input class='rowBodyInput client-extra_value' type='number' readonly='true' placeholder='0,00' min='0' step='0.01' value='{{ number_format($client->extra_value, 2, ".", ",") }}'>
                </div>
            </div>
            <div class='row'>
                <div class='key'>
                    Status da Inscrição
                </div>
                <div class='value'>
                    <span class='prefix'></span>
                    <input class='rowBodyInput client-enrollment_status' type='number' readonly='true' value='{{ $client->enrollment_status }}'>
                </div>
            </div>
            <div class='row'>
                <div class='key'>
                    Tipo de Pagamento
                </div>
                <div class='value'>
                    <span class='prefix'></span>
                    <input class='rowBodyInput client-payments_type' type='text' readonly='true' value='{{ $client->payments_type }}'>
                </div>
            </div>
            <div class='row'>
                <div class='key'>
                    Status do Pagamento
                </div>
                <div class='value'>
                    <span class='prefix'></span>
                    <input class='rowBodyInput client-payment_status' type='number' readonly='true' value='{{ $client->payment_status }}'>
                </div>
            </div>
            <div class='row'>
                <div class='key'>
                    Quantidade de Inscrições
                </div>
                <div class='value'>
                    <span class='prefix'></span>
                    <input class='rowBodyInput client-enrollments_qty' type='number' readonly='true' value='{{ count($client->enrollments) }}'>
                </div>
            </div>
            <div class='enrollments'>
                <h3 class="font-semibold text-base text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Inscrições') }}
                </h3>
                <div class='rows'>
                    @foreach($client->enrollments as $enrollment)
                    <div class='enrollment'>
                        <button class='removeEnrollment'>
                            <?php
                            echo file_get_contents(public_path("icons") . "/x.svg");
                            ?>
                        </button>
                        <div class='row'>
                            <div class='key'>
                                ID
                            </div>
                            <div class='value'>
                                <span class='prefix'></span>
                                <input class='rowBodyInput enrollment-id' type='number' readonly='true' value='{{ $enrollment->id }}'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='key'>
                                Grupo
                            </div>
                            <div class='value'>
                                <span class='prefix'></span>
                                <input class='rowBodyInput enrollment-group' type='text' readonly='true' value='{{ $enrollment->group }}'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='key'>
                                Modalidade
                            </div>
                            <div class='value'>
                                <span class='prefix'></span>
                                <input class='rowBodyInput enrollment-modality' type='text' readonly='true' value='{{ $enrollment->modality }}'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='key'>
                                Divisão
                            </div>
                            <div class='value'>
                                <span class='prefix'></span>
                                <input class='rowBodyInput enrollment-division' type='text' readonly='true' value='{{ $enrollment->division }}'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='key'>
                                Valor bruto
                            </div>
                            <div class='value'>
                                <span class='prefix'>R$ </span>
                                <input class='rowBodyInput enrollment-gross_value' type='number' readonly='true' value='{{ $enrollment->gross_value }}'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='key'>
                                Desconto
                            </div>
                            <div class='value'>
                                <span class='prefix'>R$ </span>
                                <input class='rowBodyInput enrollment-discount_value' type='number' readonly='true' value='{{ $enrollment->discount_value }}'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='key'>
                                Valor líquido
                            </div>
                            <div class='value'>
                                <span class='prefix'>R$ </span>
                                <input class='rowBodyInput enrollment-net_value' type='number' readonly='true' value='{{ $enrollment->net_value }}'>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class='buttons'>
                <button class='updateRow'>
                    Salvar
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>