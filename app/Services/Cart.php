namespace App\Services;

//App\Services\Cart
App\Entities\Admin\Product;

class Cart {

    public function __construct()
    {
        if($this->get() === null)
            $this->set($this->empty());
    }

    public function add(Product $product): void
    {
        $cart = $this->get();
        array_push($cart['products'], $product);
        $this->set($cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->get();
        array_splice($cart['products'], array_search($productId, array_column($cart['products'], 'id')), 1);
        $this->set($cart);
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    public function empty(): array
    {
        return [
            'products' => [],
        ];
    }

    public function get(): ?array
    {
        return request()->session()->get('cart');
    }

    private function set($cart): void
    {
        request()->session()->put('cart', $cart);
    }
}


<!-- {
  "6": {
    "product": {
      "id": 6,
      "name": "قميص رياضي",
      "real_price": 412,
      "photo": "http://127.0.0.1:8000/images/products/1649590033.png",
      "description": "اسود - قميص رياضي  5"
    },
    "quantity": 3,
    "275f348e-5641-4971-a16a-63dea61a004a": {
      "quantity": 3
    }
  },
} -->