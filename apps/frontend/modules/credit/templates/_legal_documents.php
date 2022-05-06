<ul>
    <li><a href="<?php echo url_for('credit/pdfPagare?id='.$credit->getId())?>"><?php echo __('Imprimir Pagaré a la Orden')?></a></li>
    <li><a href="<?php echo url_for('credit_amortization/pdf?id='.$credit->getId())?>"><?php echo __('Imprimir Tabla de Amortización')?></a></li>
</ul>



