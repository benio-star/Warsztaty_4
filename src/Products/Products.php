<?php
require_once '../../General.php';

class Products extends General {

    const VIEW_PATH = 'Products/views/';

    public function add() {

        if ($this->is_post()) {

            if ($this->addProductValidation()) {

                $name = $this->post['name'];
                $amount = $this->post['amount'];
                $price = $this->post['price'];
                $dsc = $this->post['dsc'];

                $sqlStatement = "INSERT INTO products(name, amount, price, dsc) values ('$name', '$amount', '$price', '$dsc')";

                $result = $this->getConnection()->query($sqlStatement);

                if ($result) {
                    $this->redirect('/products/index');
                }
            }

            return false;
        }

        $this->render(Products::VIEW_PATH . 'add.html');
    }

    public function edit(string $id) {

    }

    public function delete(string $id) {

    }

    public function index() {

        $result = $this->getConnection()->query('SELECT * FROM products');

        while ($row = mysqli_fetch_row($result)) {
            $data['products'][] = $row;
        }

        $this->render('Products/views/index.php', $data);
    }

    private function addProductValidation() {
        return true;
    }

    public function view(string $id) {

        //pobranie produktu o id = 1

        $data['products'] = ['name' => 'kosiarka', 'id' => $id];

        $this->render('Products/views/view.php', $data);
    }

}
