export default function auth ({next}) {
    if (!localStorage.getItem('access-token')){
        return next({
            name: 'login'
        })
    }
    return next()
}