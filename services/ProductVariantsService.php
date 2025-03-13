<?php
    class ProductVariantsService {
        private $productVariantsModel;

        public function __construct() {
            $this->productVariantsModel = new ProductVariantsModel();
        }

        public function getSizesByProductId($productId) {
            $result = $this->productVariantsModel->getSizesByProductId($productId);
            $sizes = [];

            foreach ($result as $row) {
                $sizes[] = new ProductVariantsModel(
                    $row['id'],
                    $row['product_id'],
                    $row['size'],
                    $row['stock_quantity']
                );
            }

            return $sizes;
        }

        public function getAllProductsVariants($filters = []) {
            $result = $this->productVariantsModel->getAllProductsVariants($filters);
            $productsVariants = [];

            foreach ($result as $row) {
                $productsVariants[] = new ProductVariantsModel(
                    $row['id'],
                    $row['product_id'],
                    $row['size'],
                    $row['stock_quantity']
                );
            }

            return $productsVariants;
        }

        public function getProductVariantById($id) {
            $result = $this->productVariantsModel->getProductVariantById($id);

            if ($result) {
                return new ProductVariantsModel(
                    $result['id'],
                    $result['product_id'],
                    $result['size'],
                    $result['stock_quantity']
                );
            }

            return null;
        }

        public function addProductVariant($size, $stock_quantity, $product_id) {
            $data = [
                'size' => $size,
                'stock_quantity' => $stock_quantity,
                'product_id' => $product_id
            ];

            return $this->productVariantsModel->insertProductVariant($data);
        }

        public function editProductVariant($id, $size, $stock_quantity, $product_id) {
            $product_variant = $this->getProductVariantById($id);
            if (!$product_variant) {
                throw new Exception("Biến thể sản phẩm không tồn tại.");
            }

            $data = [
                'size' => $size,
                'stock_quantity' => $stock_quantity,
                'product_id' => $product_id
            ];

            return $this->productVariantsModel->updateProductVariant($id, $data);
        }

        public function deleteProductVariant($id) {
            return $this->productVariantsModel->deleteProductVariantById($id);
        } 
    }
?>
