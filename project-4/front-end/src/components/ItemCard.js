function ItemCard({item}) {
  return (
    <div>
      <div className="item-card">
        <div className="card-content">Name:</div><div>{item.name}</div>
        <div className="card-content">Quantity:</div><div>{item.quantity}</div>
        <div className="card-content">Store ID:</div><div>{item.store_id}</div>
        <div className="card-content">Checked:</div><div>{item.checked}</div>
        <div className="card-content"><button>Delete</button></div>
      </div>
    </div>
  );
}

export default ItemCard;
