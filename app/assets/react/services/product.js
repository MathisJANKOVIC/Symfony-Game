import axios from "axios"

export const getProducts = async () => {
    return await axios.get('/api/products');
}

export const getProduct = async (id) => {
    return await axios.get(`/api/products/${id}`);
}

export const deleteProduct = async (id) => {
    return await axios.delete(`/api/products/${id}`);
}

export const patchProduct = async (product) => {
    console.log(product);

    return await axios.patch( `/api/products/${product.id}`, product, {
        headers: {
            'Content-Type': 'application/merge-patch+json'
        }
    });
}