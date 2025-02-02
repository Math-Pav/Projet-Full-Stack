export const get_location = async () => {
    const response =  await fetch(`index.php?component=map&action=get_location`,{
        method:"POST",
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
    })
    return await response.json()
}