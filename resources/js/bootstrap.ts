import axios from 'axios';

const bootstrap = () => {
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
};

export default bootstrap;
