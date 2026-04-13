<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function contact()
    {
        $contacts = Contact::orderBy('id', 'asc')->get();

        $errors = session()->get('validation_errors', []);
        session()->forget('validation_errors');

        $old = session()->get('form_old_data', []);
        session()->forget('form_old_data');

        return view('contact', ['contacts' => $contacts, 'errors' => $errors, 'old' => $old]);
    }

    public function confirm(Request $request)
    {
        $data = $this->sanitizeInput($request->all());

        $errors = $this->validateInput($data);

        if (!empty($errors)) {
            session()->put('validation_errors', $errors);
            session()->put('form_old_data', $data);
            return redirect('/contact');
        }

        session()->put('contact_input', $data);

        return view('confirm');
    }

    public function complete(Request $request)
    {
        $editId = $request->input('edit_id');

        if (!session()->has('contact_input') && !$editId) {
            return redirect('/contact');
        }

        if ($editId) {
            $data = [
                'name'         => $request->input('name'),
                'kana'         => $request->input('kana'),
                'tel'          => $request->input('tel'),
                'mail'         => $request->input('mail'),
                'contact_text' => $request->input('contact_text'),
            ];

            $errors = $this->validateInput($data);

            if (!empty($errors)) {
                session()->put('edit_errors', $errors);
                session()->put('edit_old_data', $data);
                return redirect('/edit?id=' . $editId);
            }

            Contact::where('id', $editId)->update([
                'name'       => $data['name'],
                'kana'       => $data['kana'],
                'tel'        => $data['tel'],
                'email'      => $data['mail'],
                'body'       => $data['contact_text'],
                'updated_at' => now(),
            ]);

        } else {
            $input = session()->get('contact_input');
            session()->forget('contact_input');

            Contact::create([
                'name'       => $input['name'],
                'kana'       => $input['kana'],
                'tel'        => $input['tel'],
                'email'      => $input['mail'],
                'body'       => $input['contact_text'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return view('complete');
    }

    public function goEdit(Request $request)
    {
        $id = $request->query('id');

        if (empty($id)) {
            return redirect('/contact');
        }

        session()->put('can_edit', true);

        return redirect('/edit?id=' . $id);
    }

    public function edit(Request $request)
    {
        if (!session()->has('can_edit')) {
            return redirect('/contact');
        }

        session()->forget('can_edit');

        $id = $request->query('id');

        if (empty($id)) {
            return redirect('/contact');
        }

        $contact = Contact::where('id', $id)->first();

        if (!$contact) {
            return redirect('/contact');
        }

        $errors = session()->get('edit_errors', []);
        session()->forget('edit_errors');

        $old = session()->get('edit_old_data', []);
        session()->forget('edit_old_data');

        return view('edit', ['contact' => $contact, 'errors' => $errors, 'old' => $old]);
    }

    public function delete(Request $request)
    {
        $id = $request->query('id');

        if (!empty($id)) {
            Contact::where('id', $id)->delete();
        }

        return redirect('/contact');
    }

    private function sanitizeInput($data)
    {
        return [
            'name'         => strip_tags($data['name'] ?? ''),
            'kana'         => strip_tags($data['kana'] ?? ''),
            'tel'          => preg_replace('/[^0-9]/', '', $data['tel'] ?? ''),
            'mail'         => strip_tags($data['mail'] ?? ''),
            'contact_text' => strip_tags($data['contact_text'] ?? ''),
        ];
    }

    private function validateInput($data)
    {
        $errors = [];

        if (empty(trim($data['name']))) {
            $errors['name'] = '氏名は必須入力です';
        } elseif (mb_strlen(trim($data['name']), 'UTF-8') > 10) {
            $errors['name'] = '10文字以内で入力してください';
        }

        if (empty(trim($data['kana']))) {
            $errors['kana'] = 'フリガナは必須入力です';
        } elseif (mb_strlen(trim($data['kana']), 'UTF-8') > 10) {
            $errors['kana'] = '10文字以内で入力してください';
        }

        $tel = trim($data['tel']);
        if (!empty($tel) && !preg_match('/^[0-9]+$/', $tel)) {
            $errors['tel'] = '電話番号には半角数字しか入力できません';
        }

        if (empty(trim($data['mail']))) {
            $errors['mail'] = 'メールアドレスは必須入力です';
        } elseif (!filter_var(trim($data['mail']), FILTER_VALIDATE_EMAIL)) {
            $errors['mail'] = 'メールアドレスにはメール形式(xxx@xxx.xxx)でしか入力出来ません';
        }

        if (empty(trim($data['contact_text']))) {
            $errors['contact_text'] = 'お問い合わせ内容は必須入力です';
        }

        return $errors;
    }
}
