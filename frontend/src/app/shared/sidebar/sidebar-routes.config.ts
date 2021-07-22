import { RouteInfo } from './sidebar.metadata';

export const ROUTES: RouteInfo[] = [
  {
    path: '/home',
    title: 'Home',
    icon: 'ft-home',
    class: '',
    badge: '',
    badgeClass: '',
    isExternalLink: false,
    submenu: []
  }
];

export const ADMIN_ROUTES: RouteInfo[] = [
  {
    path: '/home',
    title: 'Home',
    icon: 'ft-home',
    class: '',
    badge: '',
    badgeClass: '',
    isExternalLink: false,
    submenu: []
  },
  {
    path: '/admin/',
    title: 'Admin',
    icon: 'ft-settings',
    isExternalLink: false,
    class: 'has-sub',
    badge: '',
    badgeClass: '',
    submenu: [
      {
        path: '/users/',
        title: 'Usuarios',
        icon: 'ft-user',
        isExternalLink: false,
        class: 'has-sub',
        badge: '',
        badgeClass: '',
        submenu: [
          {
            path: '/admin/users/list',
            title: 'Lista',
            icon: 'ft-list',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          },
          {
            path: '/admin/users/add',
            title: 'Agregar',
            icon: 'ft-user-plus',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          }
        ]
      },
    ]
  },
  
  
  // {
  //   path: '/home/cursos',
  //   title: 'Cursos',
  //   icon: 'ft-home',
  //   class: '',
  //   badge: '',
  //   badgeClass: '',
  //   isExternalLink: false,
  //   submenu: []
  // },
  // {
  //   path: '/admin/solicitudesPago',
  //   title: 'Solicitudes de retiro',
  //   icon: 'ft-inbox',
  //   isExternalLink: false,
  //   class: '',
  //   badge: '',
  //   badgeClass: '',
  //   submenu: []
  // },
  {
    path: '/Solicitudes/',
    title: 'Solicitudes',
    icon: 'ft-user',
    isExternalLink: false,
    class: 'has-sub',
    badge: '',
    badgeClass: '',
    submenu: [
      {
        path: '/admin/solicitudesPago',
        title: 'Retiro',
        icon: 'ft-inbox',
        isExternalLink: false,
        class: '',
        badge: '',
        badgeClass: '',
        submenu: []
      },
      // {
      //   path: '/admin/activar',
      //   title: 'Activar',
      //   icon: 'ft-user-plus',
      //   isExternalLink: false,
      //   class: '',
      //   badge: '',
      //   badgeClass: '',
      //   submenu: []
      // },
      {
        path: '/admin/activarmgp',
        title: 'Activar MGP',
        icon: 'ft-user-plus',
        isExternalLink: false,
        class: '',
        badge: '',
        badgeClass: '',
        submenu: []
      }
    ]
  },
  // {
  //   path: '/home/accionMGP',
  //   title: 'Acciones MGP',
  //   icon: 'ft-list',
  //   isExternalLink: false,
  //   class: '',
  //   badge: '',
  //   badgeClass: '',
  //   submenu: []
  // },
  {
    path: '/home/accionmanualmgp',
    title: 'Agregar accion manual',
    icon: 'ft-list',
    isExternalLink: false,
    class: '',
    badge: '',
    badgeClass: '',
    submenu: []
  },
  {
    path: '/admin/ciclos',
    title: 'Mesas de trabajo',
    icon: 'ft-list',
    isExternalLink: false,
    class: '',
    badge: '',
    badgeClass: '',
    submenu: []
  }
  
];

export const CLIENTE_ROUTES: RouteInfo[] = [
  {
    path: '/home',
    title: 'Home',
    icon: 'ft-home',
    class: '',
    badge: '',
    badgeClass: '',
    isExternalLink: false,
    submenu: []
  },
 
  {
    path: '/home/cursos',
    title: 'Tienda',
    icon: 'ft-home',
    class: '',
    badge: '',
    badgeClass: '',
    isExternalLink: false,
    submenu: []
  },
  {
    path: '/home/referidos',
    title: 'Mis referidos',
    icon: 'ft-users',
    class: '',
    badge: '',
    badgeClass: '',
    isExternalLink: false,
    submenu: []
  },
  {
    path: '/accions/',
    title: 'Mesas de trabajo',
    icon: 'ft-user',
    isExternalLink: false,
    class: 'has-sub',
    badge: '',
    badgeClass: '',
    submenu: [
      {
        path: '/home/accion/list',
        title: 'Mis mesas',
        icon: 'ft-list',
        isExternalLink: false,
        class: '',
        badge: '',
        badgeClass: '',
        submenu: []
      },
      // {
      //   path: '/home/accion/add',
      //   title: 'Reportar pago',
      //   icon: 'ft-user-plus',
      //   isExternalLink: false,
      //   class: '',
      //   badge: '',
      //   badgeClass: '',
      //   submenu: []
      // }
    ]
  },
  {
    path: '/home/retiro',
    title: 'Retiro',
    icon: 'ft-download-cloud',
    isExternalLink: false,
    class: '',
    badge: '',
    badgeClass: '',
    submenu: []
  },
  {
    path: '/home/historico',
    title: 'Movimientos',
    icon: 'ft-layers',
    isExternalLink: false,
    class: '',
    badge: '',
    badgeClass: '',
    submenu: []
  }

];
