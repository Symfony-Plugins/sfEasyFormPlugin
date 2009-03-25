<?php

/**
 * Base Components for the sfEasyFormPlugin sfEasyForm module.
 *
 * @package     sfEasyFormPlugin
 * @subpackage  sfEasyForm
 * @author      Romain Dorgueil <romain.dorgueil@symfony-project.com>
 * @version     SVN: $Id$
 */
abstract class BasesfEasyFormComponents extends sfComponents
{
  public function executeForm(sfWebRequest $request)
  {
    if ((!isset($this->form))||!$this->form instanceof sfForm)
    {
      throw new InvalidArgumentException('sfEasyForm/form component must take a form parameter of type «sfForm».');
    }

    if (!isset($this->url))
    {
      $this->url = '';
    }

    if ((!isset($this->decorators)||!is_array($this->decorators)))
    {
      $this->decorators = array();
    }

    if (!isset($this->actions))
    {
      $this->actions = array(array('name'=>'save', 'label'=>'Sauver'));
    }
  }
}
