<?php
namespace app\controllers;

session_start();
use app\models\DeliveryModel;

class DeliveryController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new DeliveryModel($dbConnection);
    }

    public function processDelivery() {
        // Get data from the form
        $cin = $_POST['cin'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $payment_method = $_POST['payment_method'];

        // Save delivery information
        // In the processDelivery method
        if ($this->model->saveDelivery($cin, $phone_number, $address, $payment_method)) {
            $_SESSION['message'] = "Delivery information submitted successfully.";
            unset($_SESSION['panier']); // Clear the cart
        } else {
            $_SESSION['message'] = "Error occurred while submitting delivery information.";
        }

        // Redirect to a confirmation page
        header("Location: /confirmation"); // Add a route for confirmation
        exit();
    }
}
?>