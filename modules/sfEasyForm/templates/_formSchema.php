<?php

  $field = sfOutputEscaper::unescape($field);

  /* global errors */
  if ($field instanceof sfForm)
  {
    echo $field->renderGlobalErrors();
    echo '<ul class="form-root">';
  }
  else
  {
    echo $field->renderLabel();
    echo '<ul class="form-child">';
  }

  $hiddenBuffer = '';

  /* custom renderer foreach childs */
  if (isset($decorators[$starPath=$path.'/*']))
  {
    if ($decorators[$starPath])
    {
      foreach ($field as $_name => $_field)
      {
        include_partial($decorators[$starPath], array(
          'fieldName'  => $_name,
          'field'      => $_field,
          'path'       => $path.'/'.$_name,
          'decorators' => $decorators,
          'form'       => $form,
        ));
      }
    }
  }
  else
  {
    if (isset($decorators[$dirPath=$path.'/']))
    {
      if ($decorators[$dirPath])
      {
        include_partial($decorators[$dirPath], array(
          'fieldName'  => $fieldName,
          'field'      => $field,
          'path'       => $path,
          'decorators' => $decorators,
          'form'       => $form,
        ));
      }
    }
    else
    {
      foreach ($field as $_name => $_field)
      {
        $_class = get_class($_field);

        $_context = array(
          'fieldName'  => $_name,
          'field'      => $_field,
          'path'       => $path.'/'.$_name,
          'decorators' => $decorators,
          'form'       => $form,
        );

        if (isset($decorators[$newPath=$path.'/'.$_name]))
        {
          if ($decorators[$newPath])
          {
            include_partial($decorators[$newPath], $_context);
          }
        }
        else
        {
          if ($_class=='sfFormField')
          {
            if ($_field->isHidden())
            {
              $hiddenBuffer .= $_field->render();
            }
            else
            {
              echo '<li>'.$_field->renderError().$_field->renderLabel().$_field->render().'</li>';
            }

          }
          elseif ($_class=='sfFormFieldSchema')
          {
            echo '<li>'.get_partial(isset($decorators['@schema'])?$decorators['@schema']:'sfEasyForm/formSchema', $_context).'</li>';
          }
          else
          {
            throw new Exception(sprintf('Rendering of «%s» is not implemented', $_class));
          }
        }
      }
    }
  }

?></ul>
<?php echo $hiddenBuffer; ?>
