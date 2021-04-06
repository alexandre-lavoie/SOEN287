import fetch from 'node-fetch';
import { URLSearchParams } from 'url';

const baseUrl = 'http://localhost/api';

export enum Endpoint {
    accounts = '/accounts',
    aisles = "/aisles",
    carts = "/cart",
    orders = "/orders",
    products = "/items",
    splashs = "/splash"
}

export async function GET(target: Endpoint, data: any = {}) {
    const response = await fetch(`${baseUrl}${target}?${new URLSearchParams(data)}`, {
        method: 'GET'
    });

    return await response.json();
}

export async function POST(target: Endpoint, data: any = {}) {
    const response = await fetch(`${baseUrl}${target}`, {
        method: 'POST',
        body: JSON.stringify(data)
    });

    return await response.json();
}

export async function PUT(target: Endpoint, data: any = {}) {
    const response = await fetch(`${baseUrl}${target}`, {
        method: 'PUT',
        body: JSON.stringify(data)
    });

    return await response.json();
}

export async function DELETE(target: Endpoint, id: string) {
    const response = await fetch(`${baseUrl}${target}`, {
        method: 'DELETE',
        body: JSON.stringify({ id })
    });

    return await response.json();
}