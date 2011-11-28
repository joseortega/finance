<div id="detail">
  <div class="section">
    <div class="section_content">
      <table class="info">
        <tbody>
          <tr>
            <th><?php echo __('Number')?></th>
            <td><?php echo $credit->getId() ?></td>
          </tr>
          <tr>
            <th><?php echo __('Credit product')?></th>
            <td><?php echo $credit->getProduct() ?></td>
          </tr>
          <tr>
            <th><?php echo __('Credit amount')?></th>
            <td><?php echo $credit->getAmount() ?></td>
          </tr>
          <tr>
            <th><?php echo __('Balance in credit')?></th>
            <td><?php echo $credit->getBalance() ?></td>
          </tr>
          <tr>
            <th><?php echo __('Time in months')?></th>
            <td><?php echo $credit->getTimeInMonths() ?></td>
          </tr>
          <tr>
            <th><?php echo __('Pay frequency in months')?></th>
            <td><?php echo $credit->getPayFrequencyInMonths() ?></td>
          </tr>
          <tr>
            <th><?php echo __('Purpose')?></th>
            <td><?php echo $credit->getPurpose() ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="section">
    <div class="section_header">
      <h4><?php echo __('Linked Account')?></h4>
    </div>
    <div class="section_content">
        <?php include_partial('credit_account/detail', array('credit'=>$credit))?>
    </div>
  </div>

  <div class="section">
    <div class="section_header">
      <h4><?php echo __('Personal Guarantees')?></h4>
    </div>
    <div class="section_content">
        <?php include_partial('credit_guarantee_personal/detail', array('credit'=>$credit))?>
    </div>
  </div>

  <div class="section">
    <div class="section_header">
      <h4><?php echo __('Real Guarantees')?></h4>
    </div>
    <div class="section_content">
        <?php include_partial('credit_guarantee_real/detail', array('credit'=>$credit))?>
    </div>
  </div>
</div>