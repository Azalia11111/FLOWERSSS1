(() => {
  const addBtns = document.querySelectorAll('.add-to-cart');
  const cartBtn = document.getElementById('cartBtn');
  const cartModal = document.getElementById('cartModal');
  const closeCart = document.getElementById('closeCart');
  const cartItemsWrap = document.getElementById('cartItems');
  const cartCount = document.getElementById('cartCount');
  const cartTotal = document.getElementById('cartTotal');
  const STORAGE_KEY = 'flower_cart';

  function getCart(){ return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]'); }
  function saveCart(c){ localStorage.setItem(STORAGE_KEY, JSON.stringify(c)); }

  function updateUI(){
    const cart = getCart();
    cartCount.textContent = cart.reduce((s,i)=>s+i.qty,0);
    cartTotal.textContent = cart.reduce((s,i)=>s+i.qty*i.price,0);
    cartItemsWrap.innerHTML = cart.length ? cart.map(i=>`
      <div class="cart-row">
        <img src="${i.img}" style="width:48px;height:48px;object-fit:cover;border-radius:6px;margin-right:8px">
        <strong>${i.name}</strong>
        <div style="margin-left:auto">${i.qty} × ${i.price}₽</div>
      </div>
    `).join('') : '<p>Корзина пуста</p>';
  }

  function addToCart(item){
    const cart = getCart();
    const idx = cart.findIndex(i=>i.id==item.id);
    if(idx>=0) cart[idx].qty += 1; else cart.push({...item, qty:1});
    saveCart(cart); updateUI();
  }

  addBtns.forEach(b => b.addEventListener('click', e => {
    const el = e.currentTarget;
    addToCart({ id:el.dataset.id, name:el.dataset.name, price: +el.dataset.price, img: el.dataset.img });
  }));

  cartBtn.addEventListener('click', ()=> { cartModal.setAttribute('aria-hidden','false'); updateUI(); });
  closeCart.addEventListener('click', ()=> cartModal.setAttribute('aria-hidden','true'));
  document.getElementById('checkout').addEventListener('click', ()=> { alert('Оформление — демо.'); localStorage.removeItem(STORAGE_KEY); updateUI(); cartModal.setAttribute('aria-hidden','true'); });

  // init
  updateUI();
})();
