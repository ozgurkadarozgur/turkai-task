export default function redirectIfAuthenticated ({next}) {
    if (localStorage.getItem('access-token')){
        return next({
            name: 'profile'
        })
    }
    return next()
}