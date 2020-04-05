import axios from 'axios'

const instance = axios.create({
    baseURL: 'https://aqueous-tor-49981.herokuapp.com/',
    timeout: 1000,
});

export default instance