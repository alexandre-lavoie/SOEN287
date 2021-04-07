import fetch from 'node-fetch';
import { URLSearchParams } from 'url';

let baseUrl = "";

export function setBaseUrl(url: string) {
    baseUrl = url;
}

export interface IREST {}

export enum Endpoint {
    accounts = "/accounts",
    aisles = "/aisles",
    carts = "/cart",
    orders = "/orders",
    products = "/items",
    splashs = "/splash"
}

export async function GET(target: Endpoint, data: IREST = {}) {
    const response = await fetch(`${baseUrl}${target}?${new URLSearchParams(data as any)}`, {
        method: 'GET'
    });

    return await response.json();
}

export async function POST(target: Endpoint, data: IREST = {}) {
    console.log(data);

    const response = await fetch(`${baseUrl}${target}`, {
        method: 'POST',
        body: JSON.stringify(data)
    });

    console.log(await response.clone().text());

    return await response.json();
}

export async function PUT(target: Endpoint, data: IREST = {}) {
    console.log(data);

    const response = await fetch(`${baseUrl}${target}`, {
        method: 'PUT',
        body: JSON.stringify(data)
    });

    console.log(await response.clone().text());

    return await response.json();
}

export async function DELETE(target: Endpoint, id: string) {
    const response = await fetch(`${baseUrl}${target}`, {
        method: 'DELETE',
        body: JSON.stringify({ id })
    });

    return await response.json();
}