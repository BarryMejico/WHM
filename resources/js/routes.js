import Home from './components/Home'; 
import About from './components/About';
import Login from './components/Auth/LoginSys';
import Register from './components/Auth/RegisterSys';
import Dashboard from './components/Dashboard';
import Upcoming from './components/Upcoming';

import ListPO from './components/Page/ListPO';
import CreatePO from './components/Page/CreatePO';
import MainPO from './components/Page/CreatePO';

import MainVen from './components/Page/Vendor/CreateVen';
import ListVen from './components/Page/Vendor/ListVen';

import Customer from './components/Page/Customer/CreateCus';
import ListCus from './components/Page/Customer/ListCus';

import Items from './components/Page/Items/CreateItem';
import ListItem from './components/Page/Items/ListItem';

import Location from './components/Page/Location/Location';

import Receiving from './components/Page/Inventory/Receiving'; 
import Stocks from './components/Page/Inventory/Stocks';

import invoice from './components/Page/Sales/invoice';
import listInvoice from './components/Page/Sales/ListInvoice';

import DeviceHistory from './components/Page/BasicReports/DeviceHistory';
import SalesHistory from './components/Page/BasicReports/SalesHistory';
import TransactionHistory from './components/Page/BasicReports/TransactionHistory';

import Products from './components/Page/Product/CreateProduct';

import invoice2 from './components/Page/Sales/invoice2';

import company from './components/Page/company';
import companyInvite from './components/Page/companyInvite';

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
        path:'/company',
        component:company,
        name: company,
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    {
        path:'/companyInvite',
        component:companyInvite,
        name: companyInvite,
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
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
//location w/in WH
    {
        path:'/Location',
        component: Location,
        name: 'Location',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    
    
    {
        path:'/Receiving',
        component: Receiving,
        name: 'Receiving',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },

    {
        path:'/Stocks',
        component: Stocks,
        name: 'Stocks',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },

    {
        path:'/invoice',
        component: invoice,
        name: 'invoice',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },

    {
        path:'/Upcoming',
        component: Upcoming,
        name: 'Upcoming',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },

    {
        path:'/listInvoice',
        component: listInvoice,
        name: 'listInvoice',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },
    
    {
        path:'/DeviceHistory',
        component: DeviceHistory,
        name: 'DeviceHistory',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },

    {
        path:'/SalesHistory',
        component: SalesHistory,
        name: 'SalesHistory',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },

    {
        path:'/Products',
        component: Products,
        name: 'Products',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },

    {
        path:'/TransactionHistory',
        component: TransactionHistory,
        name: 'TransactionHistory',
        beforeEnter:(to,from,next)=>{
            axios.get('api/Authenticated').then(()=>{
                next()
                
            }).catch(()=>{
                return next({name: '/login_'})
            })
        }
    },

    {
        path:'/JobOrder',
        component: invoice2,
        name: 'JobOrder',
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