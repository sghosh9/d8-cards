<?php

/**
 * @file 
 * Contains \Drupal\learn_forms\Form\ConfigurationForm.
 */

namespace Drupal\learn_forms\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class ConfigurationForm extends ConfigFormBase {

  protected function getEditableConfigNames() {
    return [
      'learn_forms.configs',
    ];
  }

	public function getFormID() {
    return 'learn_forms_configuration';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $configs = $this->config('learn_forms.configs');

    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#default_value' => $configs->get('name'),
    );
    $form['gender'] = array(
      '#type' => 'radios',
      '#title' => t('Gender'),
      '#options' => array('male', 'female'),
      '#default_value' => $configs->get('gender'),
    );
    $form['age'] = array(
      '#type' => 'select',
      '#title' => t('Age'),
      '#options' => array_combine(range(22, 26), range(22, 26)),
      '#default_value' => $configs->get('age'),
    );

    return parent::buildForm($form, $form_state);
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $configs = $this->config('learn_forms.configs');
    $configs->set('name', $form_state->getValue('name'));
    $configs->set('gender', $form_state->getValue('gender'));
    $configs->set('age', $form_state->getValue('age'));
    $configs->save();
  }
}