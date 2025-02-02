export const resetImage = async (id) =>  {
    const response = await fetch(`index.php?component=pdv&action=delete-img&id=${id}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        method: 'POST',
    })

    return response.json()
}

