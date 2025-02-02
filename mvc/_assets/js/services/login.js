export const login = async (name,password) => {
    const response =  await fetch(`index.php?component=login`,{
        method:"POST",
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: new URLSearchParams({
            name:name,
            password:password
        })
    })
    return await response.json()
}