import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, createUnionType } from 'type-graphql';
import Cart, { CartResolver, CartUpdate } from './cart';
import Order, { OrderResolver } from './order';
import { GET, Endpoint, DELETE, PUT, POST, IREST } from './rest';

export interface RESTAccount extends IREST {
    id: string
    name: string
    password?: string
    address: string
    cart: string
}

@ObjectType()
export default class Account {
    @Field(type => ID)
    public id: string;

    @Field()
    public name: string;

    @Field({ nullable: true })
    public password?: string;

    @Field()
    public email: string;

    @Field()
    public address: string;

    @Field(type => Cart)
    public cart: Cart;

    @Field(type => [Order])
    public orders: Order[]
}

@InputType()
export class AccountCreate {
    @Field()
    public name: string;

    @Field()
    public password: string;

    @Field()
    public email: string;

    @Field()
    public address: string;
}

@InputType()
export class AccountUpdate {
    @Field(type => ID)
    public id: string;

    @Field({ nullable: true })
    public name?: string;

    @Field({ nullable: true })
    public password?: string;

    @Field({ nullable: true })
    public email?: string;

    @Field({ nullable: true })
    public address?: string;

    @Field(type => CartUpdate, { nullable: true })
    public cart?: CartUpdate;
}

@Resolver(of => Account)
export class AccountResolver {
    public restToQL(data: RESTAccount): Account {
        return { 
            ...data,
            cart: { id: data.cart }
        } as any
    }

    public qlToREST(account: Account): RESTAccount {
        return {
            ...account,
            cart: account.cart ? account.cart.id : account.cart
        } as any
    }

    @FieldResolver()
    async cart(@Root() account: Account): Promise<Cart> {
        return new CartResolver().cart(account.cart.id);
    }

    @FieldResolver()
    async orders(@Root() account: Account): Promise<Order[]> {
        const orders = await new OrderResolver().orders();

        return orders.filter(order => order.account.id == account.id);
    }

    @Query(returns => Account)
    async account(@Arg("id") id: string): Promise<Account> {
        const json = await GET(Endpoint.accounts, { id });

        return this.restToQL(json.accounts[id] as any);
    }

    @Query(returns => [Account])
    async accounts(): Promise<Account[]> {
        const json = await GET(Endpoint.accounts);
        
        return Object.values(json.accounts).map((account: any) => this.restToQL(account));
    }

    @Mutation(returns => Account)
    async createAccount(@Arg("input") input: AccountCreate): Promise<Account> {
        return this.restToQL(await POST(Endpoint.accounts, this.qlToREST(input as any)));
    }

    @Mutation(returns => Account)
    async updateAccount(@Arg("input") input?: AccountUpdate): Promise<Account> {
        if (input == null) return null;

        await new CartResolver().updateCart(input.cart);

        return this.restToQL(await PUT(Endpoint.accounts, this.qlToREST(input as any)));
    }

    @Mutation(returns => Account)
    async deleteAccount(@Arg("id") id: string): Promise<Account> {
        return this.restToQL(await DELETE(Endpoint.accounts, id));
    }
}