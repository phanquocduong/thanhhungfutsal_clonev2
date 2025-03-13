<?php
    class ContactController {
        private $contactView;

        public function __construct() {
            $this->contactView = new ContactView();
        }

        public function index() {
            $this->contactView->index();
        }
    }
?>