import Cookies from 'js-cookie'
import store from "../store";

const AuthenticatedLayout = () => import('../layouts/Authenticated.vue')
const GuestLayout = () => import('../layouts/Guest.vue');
const AuthenticatedUser = () => import('../layouts/AuthenticatedUser.vue')
const AuthenticatedAdmin = () => import('../layouts/AuthenticatedAdmin.vue')


const PostsIndex = () => import('../views/admin/posts/Index.vue');
const PostsCreate = () => import('../views/admin/posts/Create.vue');
const PostsEdit = () => import('../views/admin/posts/Edit.vue');
const ExercisesIndex = () => import('../views/admin/exercises/Index.vue');
const ExercisesCreate = () => import('../views/admin/exercises/Create.vue');
const ExercisesEdit = () => import('../views/admin/exercises/Edit.vue');

function requireLogin(to, from, next) {
    let isLogin = false;
    isLogin = !!store.state.auth.authenticated;

    if (isLogin) {
        next()
    } else {
        next('/login')
    }
}

function guest(to, from, next) {
    let isLogin;
    isLogin = !!store.state.auth.authenticated;

    if (isLogin) {
        next('/')
    } else {
        next()
    }
}

export default [
    {
        path: '/',
        // redirect: { name: 'login' },
        component: GuestLayout,
        children: [

            {
                path: '/',
                name: 'home',
                component: () => import('../views/home/index.vue'),
            },
            {
                path: 'posts',
                name: 'public-posts.index',
                component: () => import('../views/posts/index.vue'),
            },
            {
                path: 'producto',
                name: 'producto',
                component: () => import('../views/productoNav/producto.vue'),
            },
            {
                path: 'horarios',
                name: 'horarios',
                component: () => import('../views/horarios/horario.vue'),
            },
            {
                path: 'avisolegal',
                name: 'avisolegal',
                component: () => import('../views/avisolegal/index.vue'),
            },
            {
                path: 'cookies',
                name: 'cookies',
                component: () => import('../views/cookies/index.vue'),
            },
            {
                path: 'contacto',
                name: 'contacto',
                component: () => import('../views/contacto/index.vue'),
            },
            {
                path: 'posts/:id',
                name: 'public-posts.details',
                component: () => import('../views/posts/details.vue'),
            },
            {
                path: 'category/:id',
                name: 'category-posts.index',
                component: () => import('../views/category/posts.vue'),
            },
            {
                path: 'login',
                name: 'auth.login',
                component: () => import('../views/login/Login.vue'),
                beforeEnter: guest,
            },
            {
                path: 'register',
                name: 'auth.register',
                component: () => import('../views/register/index.vue'),
                beforeEnter: guest,
            },
            {
                path: 'forgot-password',
                name: 'auth.forgot-password',
                component: () => import('../views/auth/passwords/Email.vue'),
                beforeEnter: guest,
            },
            {
                path: 'reset-password/:token',
                name: 'auth.reset-password',
                component: () => import('../views/auth/passwords/Reset.vue'),
                beforeEnter: guest,
            },
        ]
    },
    {
        path: '/admin',
        component: AuthenticatedAdmin,
        // redirect: {
        //     name: 'admin.index'
        // },
        beforeEnter: requireLogin,
        meta: { breadCrumb: 'Dashboard' },
        children: [
            {
                name: 'admin.index',
                path: '',
                component: () => import('../views/admin/index.vue'),
                meta: { breadCrumb: 'Admin' }
            },
            {
                name: 'profile.index',
                path: 'profile',
                component: () => import('../views/admin/profile/index.vue'),
                meta: { breadCrumb: 'Profile' }
            },
            {
                name: 'posts.index',
                path: 'posts',
                component: PostsIndex,
                meta: { breadCrumb: 'Posts' }
            },
            {
                name: 'posts.create',
                path: 'posts/create',
                component: PostsCreate,
                meta: { breadCrumb: 'Add new post' }
            },
            {
                name: 'posts.edit',
                path: 'posts/edit/:id',
                component: PostsEdit,
                meta: { breadCrumb: 'Edit post' }
            },
            {
                name: 'exercises',
                path: 'exercises',
                meta: { breadCrumb: 'Exercises' },
                children: [
                    {
                        name: 'exercises.index',
                        path: '',
                        component: ExercisesIndex,
                        meta: { breadCrumb: 'View' }
                    },
                    {
                        name: 'exercises.create',
                        path: 'create',
                        component: ExercisesCreate,
                        meta: {
                            breadCrumb: 'Add new exercise',
                            linked: false,
                        }
                    },
                    {
                        name: 'exercises.edit',
                        path: 'edit/:id',
                        component: ExercisesEdit,
                        meta: {
                            breadCrumb: 'Edit exercise',
                            linked: false,
                        }
                    }
                ]
            },

            {
                name: 'categories',
                path: 'categories',
                meta: { breadCrumb: 'Categories' },
                children: [
                    {
                        name: 'categories.index',
                        path: '',
                        component: () => import('../views/admin/categories/Index.vue'),
                        meta: { breadCrumb: 'View category' }
                    },
                    {
                        name: 'categories.create',
                        path: 'create',
                        component: () => import('../views/admin/categories/Create.vue'),
                        meta: {
                            breadCrumb: 'Add new category',
                            linked: false,
                        }
                    },
                    {
                        name: 'categories.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/categories/Edit.vue'),
                        meta: {
                            breadCrumb: 'Edit category',
                            linked: false,
                        }
                    }
                ]
            },

         
            //-------------------------------------------------------------------------------------------------------------------------

            //espacio ruta vistas horarios gym
            {
                name: 'horario',
                path: 'horario',
                meta: { breadCrumb: 'Horario' },
                children: [
                    {
                        name: 'horario.index',
                        path: '',
                        component: () => import('../views/admin/horario/index.vue'),
                        meta: { breadCrumb: 'Ver horarios' }
                    },
                    {
                        name: 'horario.create',
                        path: 'create',
                        component: () => import('../views/admin/horario/create.vue'),
                        meta: { breadCrumb: 'Crear horarios' }
                    },
                    {
                        name: 'horario.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/horario/edit.vue'),
                        meta: {
                            breadCrumb: 'Edit horario',
                            linked: false,
                        }
                    }
                ]
            },
          
            //-------------------------------------------------------------------------------------------------------------------------

            //espacio ruta vistas horarios gym
            {
                name: 'actividad',
                path: 'actividad',
                meta: { breadCrumb: 'Actividad' },
                children: [
                    {
                        name: 'actividad.index',
                        path: '',
                        component: () => import('../views/admin/actividad/index.vue'),
                        meta: { breadCrumb: 'Ver actividads' }
                    },
                    {
                        name: 'actividad.create',
                        path: 'create',
                        component: () => import('../views/admin/actividad/create.vue'),
                        meta: { breadCrumb: 'Crear actividads' }
                    },
                    {
                        name: 'actividad.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/actividad/edit.vue'),
                        meta: {
                            breadCrumb: 'Edit actividad',
                            linked: false,
                        }
                    }
                ]
            },
                  
            //----------------------------------------------------------------------------------------------------------------------

            //espacio vista productos
            {
                name: 'producto',
                path: 'producto',
                meta: { breadCrumb: 'Producto' },
                children: [
                    {
                        name: 'producto.index',
                        path: '',
                        component: () => import('../views/admin/producto/index.vue'),
                        meta: { breadCrumb: 'Ver productos' }
                    },

                    {
                        name: 'producto.create',
                        path: 'create',
                        component: () => import('../views/admin/producto/create.vue'),
                        meta: { breadCrumb: 'Crear producto' }
                    },

                    {
                        name: 'producto.edit',
                        path: 'edit:id',
                        component: () => import('../views/admin/producto/edit.vue'),
                        meta: { 
                            breadCrumb: 'Editar producto',
                            linked: false,
                        }
                         
                    }

                ]
            },
               
            //----------------------------------------------------------------------------------------------------------------------

            //espacio vista tareas falta añadir editar
            {
                name: 'tasks',
                path: 'tasks',
                meta: { breadCrumb: 'Tareas' },
                children: [
                    {
                        name: 'task.index',
                        path: '',
                        component: () => import('../views/admin/tasks/index.vue'),
                        meta: { breadCrumb: 'Ver tareas' }
                    },

                    {
                        name: 'task.create',
                        path: 'create',
                        component: () => import('../views/admin/tasks/create.vue'),
                        meta: { breadCrumb: 'Crear tareas'
                     }
                    }

                ]
            },
            //----------------------------------------------------------------------------------------------------------------------------

            //espacio vista nivel

            {
                name: 'nivel',
                path: 'nivel',
                meta: { breadCrumb: 'Niveles' },
                children: [
                    {
                        name: 'nivel.index',
                        path: '',
                        component: () => import('../views/admin/nivel/index.vue'),
                        meta: { breadCrumb: 'Ver niveles' }
                    },

                    {
                        name: 'nivel.create',
                        path: 'create',
                        component: () => import('../views/admin/nivel/create.vue'),
                        meta: { breadCrumb: 'Crear niveles' }
                    },
                    {
                        name: 'nivel.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/nivel/edit.vue'),
                        meta: {
                            breadCrumb: 'Edit nivel',
                            linked: false,
                        }
                    }

                ]
            },

            //-----------------------------------------------------------------------------------------------------------------------------------
            //espacio vista inscripcions

            {
                name: 'inscripcion',
                path: 'inscripcion',
                meta: { breadCrumb: 'Inscripcion' },
                children: [
                    {
                        name: 'inscripcion.index',
                        path: '',
                        component: () => import('../views/admin/inscripcion/index.vue'),
                        meta: { breadCrumb: 'Ver inscripciones' }
                    },

                    {
                        name: 'inscripcion.create',
                        path: 'create',
                        component: () => import('../views/admin/inscripcion/create.vue'),
                        meta: { breadCrumb: 'Crear inscripciones' }
                    },

                    {
                        name: 'inscripcion.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/inscripcion/edit.vue'),
                        meta: {
                            breadCrumb: 'Edit inscripcion',
                            linked: false,
                        }
                    }



                ]
            },

            //------------------------------------------------------------------------------------------------------------------------------

            {
                name: 'permissions',
                path: 'permissions',
                meta: { breadCrumb: 'Permisos' },
                children: [
                    {
                        name: 'permissions.index',
                        path: '',
                        component: () => import('../views/admin/permissions/Index.vue'),
                        meta: { breadCrumb: 'Permissions' }
                    },
                    {
                        name: 'permissions.create',
                        path: 'create',
                        component: () => import('../views/admin/permissions/Create.vue'),
                        meta: {
                            breadCrumb: 'Create Permission',
                            linked: false,
                        }
                    },
                    {
                        name: 'permissions.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/permissions/Edit.vue'),
                        meta: {
                            breadCrumb: 'Permission Edit',
                            linked: false,
                        }
                    }
                ]
            },

            //TODO Organizar rutas
            {
                name: 'roles.index',
                path: 'roles',
                component: () => import('../views/admin/roles/Index.vue'),
                meta: { breadCrumb: 'Roles' }
            },
            {
                name: 'roles.create',
                path: 'roles/create',
                component: () => import('../views/admin/roles/Create.vue'),
                meta: { breadCrumb: 'Create Role' }
            },
            {
                name: 'roles.edit',
                path: 'roles/edit/:id',
                component: () => import('../views/admin/roles/Edit.vue'),
                meta: { breadCrumb: 'Role Edit' }
            },
            {
                name: 'users.index',
                path: 'users',
                component: () => import('../views/admin/users/Index.vue'),
                meta: { breadCrumb: 'Users' }
            },
            {
                name: 'users.create',
                path: 'users/create',
                component: () => import('../views/admin/users/Create.vue'),
                meta: { breadCrumb: 'Add New' }
            },
            {
                name: 'users.edit',
                path: 'users/edit/:id',
                component: () => import('../views/admin/users/Edit.vue'),
                meta: { breadCrumb: 'User Edit' }
            },
        ]
    },
    {
        path: "/:pathMatch(.*)*",
        name: 'NotFound',
        component: () => import("../views/errors/404.vue"),
    },
    //Espacio para vistas alumno
    {
        path: '/alumno',
        component: AuthenticatedUser,
        // redirect: {
        //     name: 'alumno.index'
        // },
        beforeEnter: requireLogin,
        meta: { breadCrumb: 'Dashboard' },
        children: [
            //espacio vistas clase alumnos
            {
                name: 'clase',
                path: 'clase',
                meta: { breadCrumb: 'Clase' },
                children: [
                    {
                        name: 'clase.index',
                        path: '',
                        component: () => import('../views/alumno/clase/index.vue'),
                        meta: { breadCrumb: 'Ver resultados tabla clases' }
                    },

                    {
                        name: 'clase.create',
                        path: 'create',
                        component: () => import('../views/alumno/clase/create.vue'),
                        meta: { breadCrumb: 'Crear clase' }
                    }


                ]
            },

        ]
    }
];




