function Header() {
  return (
    <div>
      <p id="header-title">Shopmart</p>
      <div className="header">
          <a href="/">Home</a><a href="/browse">Browse Items</a><a href="/stores">Stores</a><a href="/add">Add</a>
      </div>
    </div>
  );
}

export default Header;
