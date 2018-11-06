import AlbumIndex from './pages/album.index';
import AlbumCreate from './pages/album.create';
import AlbumShow from './pages/album.show';
import PhotoCreate from './pages/photo.create';


import Login from './pages/auth.login';
import Register from './pages/auth.register';

const routes = [

    { path: '/', component: AlbumIndex, name: 'album.index' },
    { path: '/album/create', component: AlbumCreate, name: 'album.create' },
    { path: '/album/show/:id', component: AlbumShow, name: 'album.show' },
    { path: '/photo/create/:albumId', component: PhotoCreate, name: 'photo.create' },

    { path: '/login', component: Login, name: 'auth.login' },
    { path: '/register', component: Register, name: 'auth.register' },

    { path: '*', redirect: '/' }
];

export default routes;