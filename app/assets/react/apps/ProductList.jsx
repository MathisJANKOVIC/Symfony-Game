import React, {useEffect, useState} from 'react';

import {getProducts, patchProduct, deleteProduct} from '../services/product';

const ProductCard = ({setSelectedEditProduct, product}) => {
    const onClickEditButtonHandler = (product) => {
        console.log('edit');
        setSelectedEditProduct(product);
    };

    const onClickDeleteButtonHandler = async (product) => {
        console.log('delete');
        
        if (confirm('Etes vous sur ?')) {
            await deleteProduct(product.id);
            await getData();
        }
    }

    return <div className="card h-100">
        <div className="card-body">
            <h5 className="card-title">{product.name}</h5>
            <p>{product.description.substring(0, 20)} {product.description.length >= 20 && '...'}</p>
            <p className="fw-bold text-end">{product.price} €</p>
        </div>
        <div className="card-footer">
            <button type="button" onClick={e => onClickEditButtonHandler(product)} className="btn btn-primary">Edit</button>
            <button type="button" onClick={e => onClickDeleteButtonHandler(product)} className="btn btn-danger">Delete</button>
        </div>
    </div>;
}

const ProductEdit = ({setSelectedEditProduct, product}) => {
    const [p, setP] = useState(product);
    
    const onSubmitHandler = async (event) => {
        event.preventDefault();
        console.log('submit');
        await patchProduct(p);
        setSelectedEditProduct(null);
    }

    const onClickCancelButtonHandler = () => {
        console.log('cancel')
        setSelectedEditProduct(null)
    }

    const onChangeHandler = (event) => {
        let {name, value} = event.target;
        console.log(name, value);

        if (name == 'price') {
            value = parseFloat(value);
        }

        setP({...p, [name]: value})
    }

    return <div className="card h-100">
        <form onSubmit={onSubmitHandler}>
            <div className="card-body">
                <div className="mb-3">
                    <input 
                        name='name'
                        type='text'
                        value={p.name}
                        required={true}
                        className='form-control'
                        placeholder='Nom'
                        onChange={onChangeHandler}
                    />
                </div>
                <div className="mb-3">
                    <input 
                        name='price'
                        type='number'
                        value={p.price}
                        required={true}
                        className='form-control'
                        placeholder='Prix'
                        onChange={onChangeHandler}
                    />
                </div>
            </div>
            <div className="card-footer">
                <button type="submit" className="btn btn-success">Save</button>
                <button type="button" onClick={e => onClickCancelButtonHandler()} className="btn btn-secondary">Cancel</button>
            </div>
        </form>
    </div>;
}

const ProductNew = () => {
    return (<h1>Add</h1>)
}

const ProductList = () => {
    const [data, setData] = useState([]);
    const [add, setAdd] = useState(false);
    const [selectedEditProduct, setSelectedEditProduct] = useState(null);

    const getData = async () => {
        const res = await getProducts();
        setData(res.data['hydra:member']);
    };
    
    useEffect(() => {
        console.log('useEffect')
        getData();
    }, [selectedEditProduct]);

    const handleOnclick = () => {
        if (add) {
            setAdd(false)
        } else {
            setAdd(true)
        }
    };

    return <>
        <div className="d-flex justify-content-between">
            <h1>Liste des produits</h1>
            <div>
                { !add &&<button onClick={handleOnclick} className="btn btn-success">Ajout un produit</button> }
                { add &&<button onClick={handleOnclick} className="btn btn-secondary">Retour</button> }
            </div>
        </div>
        <div className="row row-cols-1 row-cols-md-3 g-4">
            {!add && data.map((value, index) => {
                return <div key={index} className="col">
                    { ((!selectedEditProduct) || (selectedEditProduct.id !== value.id)) && <ProductCard setSelectedEditProduct={setSelectedEditProduct} product={value} /> }
                    {selectedEditProduct && selectedEditProduct.id === value.id && <ProductEdit setSelectedEditProduct={setSelectedEditProduct} product={value} /> }
                </div>
            })}

            { add && <ProductNew /> }
        </div>
    </>;
}

export default ProductList;
