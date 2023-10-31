import { reactive } from 'vue';

export const store = reactive({
    isAutenticathed : false,
    registerErrors: [],
    loginErrors: [],
    checkingToken: false,
    stat: true,
    stats: null,
    first: '',
    categories: [],
    loading: false,
    total: null,
    remaining: null,
    expenseCalc: [],
    months: [],
    totalForMonth: [],
    minLoad: false,
    StatComponent: true,
    TransactionsComponent: false,
    transactions: []
})