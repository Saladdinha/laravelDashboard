    <div class='filters'>
        <div class='filterBox'>
            <div class='title'>
                <label>
                    Palavra chave
                </label>
            </div>
            <div class='head'>
                <input class='keyword' placeholder="Ex: Nome ou Cpf">
            </div>
        </div>
        <div class='filterBox select fieldsSelect'>
            <div class='title'>
                <label>
                    Campos
                </label>
            </div>
            <div class='head'>
                <input placeholder="Procurar">
                <span class='svg'>
                    <?php
                    echo file_get_contents(public_path("icons") . "/arrow.svg");
                    ?>
                </span>
            </div>
            <div class='content'>
                <div class='options'>
                    <label class='option' for='name'>
                        <input class='inputOption ' value="name" type='checkbox' id='name' name='name'>
                        <span class='text'>Nome</span>
                    </label>
                    <label class='option' for='cpf'>
                        <input class='inputOption ' value="document" type='checkbox' id='cpf' name='document'>
                        <span class='text'>CPF</span>
                    </label>
                    <label class='option' for='stage'>
                        <input class='inputOption ' value="stage" type='checkbox' id='stage' name='stage'>
                        <span class='text'>Estágio</span>
                    </label>
                    <label class='option' for='group'>
                        <input class='inputOption ' value="grupo" type='checkbox' id='group' name='group'>
                        <span class='text'>Grupo</span>
                    </label>
                    <label class='option' for='modality'>
                        <input class='inputOption ' value="modalidade" type='checkbox' id='modality' name='modality'>
                        <span class='text'>Modalidade</span>
                    </label>
                    <label class='option' for='division'>
                        <input class='inputOption ' value="divisao" type='checkbox' id='division' name='division'>
                        <span class='text'>Divisão</span>
                    </label>
                </div>
            </div>
        </div>
        <div class='filterBox'>
            <div class='title'>
                <label>
                    Valor
                </label>
            </div>
            <div class='head'>
                <label class='text' for='value'>
                    R$:
                </label>
                <input class='value' type='number' id='value' placeholder='0,00' min='0' step='0.01'>
            </div>
            <div class='content'>

            </div>
        </div>
        <div class='filterBox'>
            <div class='title'>
                <label>
                    Desconto
                </label>
            </div>
            <div class='head'>
                <label class='text' for='discount'>
                    R$:
                </label>
                <input type='number' class='discount_value' id='discount' placeholder='0,00' min='0' step='0.01'>
            </div>
            <div class='content'>

            </div>
        </div>
        <div class='filterBox select single'>
            <div class='title'>
                <label>
                    Status da inscrição
                </label>
            </div>
            <div class='head'>
                <input placeholder="Procurar">
                <span class='svg'>
                    <?php
                    echo file_get_contents(public_path("icons") . "/arrow.svg");
                    ?>
                </span>
            </div>
            <div class='content'>
                <div class='options'>
                </div>
            </div>
        </div>
        <div class='filterBox select single'>
            <div class='title'>
                <label>
                    Tipo de pagamento
                </label>
            </div>
            <div class='head'>
                <input placeholder="Procurar">
                <span class='svg'>
                    <?php
                    echo file_get_contents(public_path("icons") . "/arrow.svg");
                    ?>
                </span>
            </div>
            <div class='content'>
                <div class='options'>
                </div>
            </div>
        </div>
        <div class='filterBox select single'>
            <div class='title'>
                <label>
                    Status do pagamento
                </label>
            </div>
            <div class='head'>
                <input placeholder="Procurar">
                <span class='svg'>
                    <?php
                    echo file_get_contents(public_path("icons") . "/arrow.svg");
                    ?>
                </span>
            </div>
            <div class='content'>
                <div class='options'>
                </div>
            </div>
        </div>
        <div class='filterBox'>
            <div class='title'>
                <label>
                    Quantidade de inscrições
                </label>
            </div>
            <div class='head'>
                <label class='text' for='enrollments_qty'>
                </label>
                <input type='number' class='enrollments_qty' id='enrollments_qty' placeholder='0' min=0 step=1>
            </div>
        </div>
        <div class='filterBox'>
            <div class='title'>
                <label>
                    Data inicio
                </label>
            </div>
            <div class='head'>
                <label class='text' for='init_date'>
                </label>
                <input type='text' class='date init_date' id='init_date' maxlength="10" placeholder='<?php echo date("d-m-Y"); ?>'>
            </div>
        </div>
        <div class='filterBox'>
            <div class='title'>
                <label>
                    Data Fim
                </label>
            </div>
            <div class='head'>
                <label class='text' for='end_date'>
                </label>
                <input type='text' class='date end_date' id='end_date' maxlength="10" placeholder='<?php echo date("d-m-Y"); ?>'>
            </div>
        </div>
    </div>
    <div class='submitFilter'>
        <button type="button" class='filterBtn'>Filtrar</button>
    </div>
    <form method="GET" class='submitForm' style="display:none!important">
        <input name='keyword'>
        <input name='fields'>
        <input name='value'>
        <input name='discount_value'>
        <input name='enrollment_status'>
        <input name='payment_status'>
        <input name='payment_type'>
        <input name='enrollments_qty'>
        <input name='init_date'>
        <input name='end_date'>
    </form>
    <script src='{{ URL::asset('js/filter.js') }}'></script>