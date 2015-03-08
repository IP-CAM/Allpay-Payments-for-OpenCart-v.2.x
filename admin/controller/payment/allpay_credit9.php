<?php

class ControllerPaymentAllpayCredit9 extends Controller {

    private $paymentSubfix = 'credit9';
    private $error = array();

    public function index() {
        $this->load->language('payment/allpay_payment');
        $this->load->model('setting/setting');
        $this->load->model('localisation/language');
        $this->load->model('localisation/geo_zone');
        $this->load->model('localisation/order_status');

        $languages = $this->model_localisation_language->getLanguages();

        $data['languages'] = $languages;
        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $this->document->setTitle($this->language->get('heading_' . $this->paymentSubfix . '_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('allpay_' . $this->paymentSubfix . '', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_' . $this->paymentSubfix . '_title');

		$data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');

        $data['entry_subfix'] = $this->paymentSubfix;
        $data['entry_bank'] = $this->language->get('heading_' . $this->paymentSubfix . '_title');
        $data['entry_test_mode'] = $this->language->get('entry_test_mode');
		$data['entry_test_fix'] = $this->language->get('entry_test_fix');
        $data['entry_merchant_id'] = $this->language->get('entry_merchant_id');
        $data['entry_hash_key'] = $this->language->get('entry_hash_key');
        $data['entry_hash_iv'] = $this->language->get('entry_hash_iv');
        $data['entry_order_status'] = $this->language->get('entry_order_status');
        $data['entry_order_finish_status'] = $this->language->get('entry_order_finish_status');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_general'] = $this->language->get('tab_general');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->error['warning2'])) {
            $data['error_warning2'] = $this->error['warning2'];
        } else {
            $data['error_warning2'] = '';
        }
        if (isset($this->error['warning3'])) {
            $data['error_warning3'] = $this->error['warning3'];
        } else {
            $data['error_warning3'] = '';
        }
        if (isset($this->error['warning4'])) {
            $data['error_warning4'] = $this->error['warning4'];
        } else {
            $data['error_warning4'] = '';
        }
		if (isset($this->error['warning5'])) {
            $data['error_warning5'] = $this->error['warning5'];
        } else {
            $data['error_warning5'] = '';
        }

        foreach ($languages as $language) {
            if (isset($this->error['bank' . $language['language_id']])) {
                $data['error_bank' . $language['language_id']] = $this->error['bank' . $language['language_id']];
            } else {
                $data['error_bank' . $language['language_id']] = '';
            }
        }

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_' . $this->paymentSubfix . '_title'),
            'href' => $this->url->link('payment/allpay_' . $this->paymentSubfix . '', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['action'] = $this->url->link('payment/allpay_' . $this->paymentSubfix . '', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        foreach ($languages as $language) {
            if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_description_' . $language['language_id']])) {
                $data['allpay_payment_description_' . $language['language_id']] = $this->request->post['allpay_' . $this->paymentSubfix . '_description_' . $language['language_id']];
            } else {
                $data['allpay_payment_description_' . $language['language_id']] = $this->config->get('allpay_' . $this->paymentSubfix . '_description_' . $language['language_id']);
            }
        }

        if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_order_status_id'])) {
            $data['allpay_order_status_id'] = $this->request->post['allpay_' . $this->paymentSubfix . '_order_status_id'];
        } else {
            $data['allpay_order_status_id'] = $this->config->get('allpay_' . $this->paymentSubfix . '_order_status_id');
        }
        if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_order_finish_status_id'])) {
            $data['allpay_order_finish_status_id'] = $this->request->post['allpay_' . $this->paymentSubfix . '_order_finish_status_id'];
        } else {
            $data['allpay_order_finish_status_id'] = $this->config->get('allpay_' . $this->paymentSubfix . '_order_finish_status_id');
        }
        if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_geo_zone_id'])) {
            $data['allpay_geo_zone_id'] = $this->request->post['allpay_' . $this->paymentSubfix . '_geo_zone_id'];
        } else {
            $data['allpay_geo_zone_id'] = $this->config->get('allpay_' . $this->paymentSubfix . '_geo_zone_id');
        }
        if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_status'])) {
            $data['allpay_status'] = $this->request->post['allpay_' . $this->paymentSubfix . '_status'];
        } else {
            $data['allpay_status'] = $this->config->get('allpay_' . $this->paymentSubfix . '_status');
        }
        if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_sort_order'])) {
            $data['allpay_sort_order'] = $this->request->post['allpay_' . $this->paymentSubfix . '_sort_order'];
        } else {
            $data['allpay_sort_order'] = $this->config->get('allpay_' . $this->paymentSubfix . '_sort_order');
        }
        if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_test_mode'])) {
            $data['allpay_test_mode'] = $this->request->post['allpay_' . $this->paymentSubfix . '_test_mode'];
        } else {
            $data['allpay_test_mode'] = $this->config->get('allpay_' . $this->paymentSubfix . '_test_mode');
        }
		if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_test_fix'])) {
            $data['allpay_test_fix'] = $this->request->post['allpay_' . $this->paymentSubfix . '_test_fix'];
        } else {
            $data['allpay_test_fix'] = $this->config->get('allpay_' . $this->paymentSubfix . '_test_fix');
        }
        if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_merchant_id'])) {
            $data['allpay_merchant_id'] = $this->request->post['allpay_' . $this->paymentSubfix . '_merchant_id'];
        } else {
            $data['allpay_merchant_id'] = $this->config->get('allpay_' . $this->paymentSubfix . '_merchant_id');
        }
        if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_hash_key'])) {
            $data['allpay_hash_key'] = $this->request->post['allpay_' . $this->paymentSubfix . '_hash_key'];
        } else {
            $data['allpay_hash_key'] = $this->config->get('allpay_' . $this->paymentSubfix . '_hash_key');
        }
        if (isset($this->request->post['allpay_' . $this->paymentSubfix . '_hash_iv'])) {
            $data['allpay_hash_iv'] = $this->request->post['allpay_' . $this->paymentSubfix . '_hash_iv'];
        } else {
            $data['allpay_hash_iv'] = $this->config->get('allpay_' . $this->paymentSubfix . '_hash_iv');
        }

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('payment/allpay_payment.tpl', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'payment/allpay_' . $this->paymentSubfix . '')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if (!$this->request->post['allpay_' . $this->paymentSubfix . '_merchant_id']) {
            $this->error['warning2'] = $this->language->get('error_merchant_id');
        }
        if (!$this->request->post['allpay_' . $this->paymentSubfix . '_hash_key']) {
            $this->error['warning3'] = $this->language->get('error_hash_key');
        }
        if (!$this->request->post['allpay_' . $this->paymentSubfix . '_hash_iv']) {
            $this->error['warning4'] = $this->language->get('error_hash_iv');
        }
		if ($this->request->post['allpay_' . $this->paymentSubfix . '_test_mode'] == "1") {
			if (!$this->request->post['allpay_' . $this->paymentSubfix . '_test_fix']) {
				$this->error['warning5'] = $this->language->get('error_test_fix');
			}			
			else if(!preg_match("/^[A-Za-z0-9]+$/", $this->request->post['allpay_' . $this->paymentSubfix . '_test_fix'])) {
				$this->error['warning5'] = $this->language->get('error_test_fix2');
			}			  
		}
		
        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
