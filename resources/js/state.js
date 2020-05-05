import axios from 'axios'
import {BASE_URL} from "./constants";

export default {
    state: {
        token: localStorage.getItem('access-token') || '',
        status: '',
        user: '',
        students: [],
        validation_errors: [],
    },
    getters: {
        isAuthenticated(state) {
            return !!state.token
        },
        getToken(state) {
            return state.token
        },
        getUser(state) {
            return state.user
        },
        getStudents(state) {
            return state.students
        },
        getValidationErrors(state) {
            return state.validation_errors
        }
    },
    actions: {
        register: async ({commit}, user) => {
          try {
              let res = await axios.post(BASE_URL + 'families', {
                  first_name: user.first_name,
                  last_name: user.last_name,
                  email: user.email,
                  password: user.password,
                  code: user.code
              })
              return {
                  status: 'success'
              }
          }  catch (e) {
              console.log(e)
              if (e.response.status === 422) {
                  return {
                      status: 'err',
                      data: e.response.data.errors
                  }
                  //commit("set_validation_errors", e.response.data.errors)
              }
          }
        },
        login: async ({commit, dispatch, state}, user) => {
            try {
                let res = await axios.post(BASE_URL + 'auth/login', {
                    email: user.email,
                    password: user.password
                })
                const token = res.data.data.access_token
                localStorage.setItem('access-token', token)
                commit("login_success", token)
                await dispatch("user_request")
            } catch (e) {
                console.log('myerr', e.response)
                if (e.response.status === 422) {
                    commit("set_validation_errors", e.response.data.errors)
                }
                if (e.response.status === 401) {
                    commit("set_validation_errors", e.response.data.errors)
                }

            }
        },
        logout: async ({commit}) => {
            localStorage.removeItem('access-token')
            commit('set_user', null)
        },
        update: async ({commit, getters}, user) => {
            try {
                let res = await axios.put(BASE_URL + 'families', {
                   first_name: user.first_name,
                   last_name: user.last_name
                }, {
                    headers: {Authorization: 'Bearer ' + getters.getToken}
                })
                const data = res.data.data
                console.log(data)
                commit("set_user", data)

            } catch (e) {
                console.log(e)
            }
        },
        user_request: async ({commit, getters}) => {
            try {
                let res = await axios.get(BASE_URL + 'user', {
                    headers: {Authorization: 'Bearer ' + getters.getToken}
                })
                const user = res.data.data
                commit("set_user", user)
            } catch (e) {
                console.log(e)
            }
        },
        students: async ({commit, getters}) => {
            try {
                let res = await axios.get(BASE_URL + 'students', {
                    headers: { Authorization: 'Bearer ' + getters.getToken }
                });
                let students = res.data.data;
                commit('set_students', students)

            } catch (e) {
                console.log(e)
            }
        }
    },
    mutations: {
        login_success: (state, token) => {
            state.status = 'success'
            state.token = token
        },
        login_err: (state) => {
            state.status = 'error'
        },
        set_user: (state, user) => {
            state.user = user
        },
        set_students: (state, students) => {
            state.students = students
        },
        set_validation_errors: (state, errors) => {
            state.validation_errors = errors
        }
    }
}