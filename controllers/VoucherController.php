<?php
require_once 'BaseController.php';
require_once '/../models/Voucher.php';

/**
*
*/
class VoucherController extends BaseController
{

  public function __construct()
  {
    $this->authorize();
  }

  public function index()
  {
    $data['vouchers'] = (new Voucher)->all();
    return $data;
  }

  public function show()
  {
    $data['voucher'] = (new Voucher)->find(request('id'));
    if (!$data['voucher']) set_session('alert-warning', 'The voucher doesn\'t exist.');
    return $data;
  }

  public function create()
  {
    $status = (new Voucher)->insert(
      ['name' => request('name'), 'description' => request('description'), 'created_at' => date("d/m/Y")]
    );
    if ($status) {
      set_session('alert-success', 'Voucher created successfully.');
    } else {
      set_session('alert-warning', 'Voucher could not be created.');
    }
    return $this->redirect('voucher_index');
  }

  public function edit()
  {
    $data['voucher'] = (new Voucher)->find(request('id'));
    if (!$data['voucher']) set_session('alert-warning', 'The voucher doesn\'t exist.');
    return $data;
  }

  public function update()
  {
    $data['voucher'] = (new Voucher)->update(request('id'), [
      'name' => request('name'), 'description' => request('description')
    ]);
    if ($data['voucher']) {
      set_session('alert-success', 'Voucher deleted successfully.');
    } else {
      set_session('alert-warning', 'The voucher doesn\'t exist.');
    }
    return $this->redirect('voucher_index');
  }

  public function destroy()
  {
    (new Voucher)->disassociate('user_voucher', 'voucher_id', request('id'));
    $data['voucher'] = (new Voucher)->destroy(request('id'));
    if ($data['voucher']) {
      set_session('alert-success', 'Voucher deleted successfully.');
    } else {
      set_session('alert-warning', 'The voucher doesn\'t exist.');
    }
    return $this->redirect('voucher_index');
  }

  public function associate_user()
  {
    $token = $_COOKIE['user'];
    $user = (new User)->where('token', $token)[0];
    $status = (new Voucher)->add_user($user['id'], request('id'));
    if ($status) {
      set_session('alert-success', 'Voucher association successfully.');
    } else {
      set_session('alert-warning', 'The voucher doesn\'t exist.');
    }
    $this->redirect('profile');
  }
}

$controller = new VoucherController();
