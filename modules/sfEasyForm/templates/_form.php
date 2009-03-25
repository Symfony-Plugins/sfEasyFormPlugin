<?php use_helper('I18N'); ?>

<?php if (sfConfig::get('sf_debug') && $form->hasErrors()): ?>
  <div style="border: 1px dashed #600;">
    <b>Error Schema:</b>
    <pre><?php echo $form->getErrorSchema(); ?></pre>
  </div>
<?php endif; ?>

<form action="<?php echo $url; ?>" method="POST" <?php if (isset($formId)&&$formId): ?>id="<?php echo $formId; ?>"<?php endif; ?>>
  <?php
    include_partial(isset($decorators['@schema'])?$decorators['@schema']:'sfEasyForm/formSchema', array(
      'fieldName'  => '',
      'field'      => $form,
      'form'       => $form,
      'path'       => '',
      'decorators' => $decorators
      )
    );
  ?>

  <?php include_partial(isset($decorator['@actions'])?$decorator['@actions']:'sfEasyForm/formActions', array('actions'=>$actions)); ?>
</form>

