import Students from './components/Students.vue';
import AddStudent from './components/AddStudent.vue';
import UpdateStudent from './components/UpdateStudent.vue';

export const routes = [{
        name: 'home',
        path: '/',
        component: Students
    },
    {
        name: 'add',
        path: '/add',
        component: AddStudent
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: UpdateStudent
    }
];
