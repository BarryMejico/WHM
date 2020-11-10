import Home from './components/Home';
import About from './components/About';
import Login from './components/Auth/LoginSys';
import Register from './components/Auth/RegisterSys';
import Dashboard from './components/Dashboard';

import ListPO from './components/Page/ListPO';
import CreatePO from './components/Page/CreatePO';
import MainPO from './components/Page/CreatePO';

import MainVen from './components/Page/Vendor/CreateVen';
import ListVen from './components/Page/Vendor/ListVen';

import Customer from './components/Page/Customer/CreateCus';
import ListCus from './components/Page/Customer/ListCus';

import Items from './components/Page/Items/CreateItem';
import ListItem from './components/Page/Items/ListItem';

import { before } from 'lodash';
export default{
    mode: 'history',
    routes: [
        {
        path:'/',
        component: Home
    },
    {
        path:'/about',
        component: About
    },
    {
        path:'/login_',
        component: Login,
        name:'/login_'
    },
    {
        path:'/register_',
        component: Register
    },
    {
        path:'/PO',
        component: MainPO,
        name: 'PO',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    {
        path:'/Dashboard',
        component: Dashboard,
        name: 'Dashboard',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    {
        path:'/PO_list',
        component: ListPO,
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    {
        path:'/PO_Create',
        component: CreatePO,
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    {
        path:'/Vendor_Create',
        component: MainVen,
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    {
        path:'/Vendor_List',
        component: ListVen,
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    {
        path:'/Customer_Create',
        component: Customer,
        name: 'Customer',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    {
        path:'/Customer_List',
        component: ListCus,
        name: 'CustomerList',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    //Items
    {
        path:'/Items_Create',
        component: Items,
        name: 'Item',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    
    {
        path:'/Items_List',
        component: ListItem,
        name: 'ItemList',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    
]
}