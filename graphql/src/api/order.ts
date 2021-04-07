import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, ResolverInterface } from 'type-graphql';
import Account, { AccountResolver, AccountUpdate } from './account';
import Cart, { CartResolver, CartUpdate } from './cart';
import { DELETE, Endpoint, GET, IREST, POST, PUT } from './rest';

export interface RESTOrder extends IREST {
    id: string 
    time: string
    account: string
    cart: string
}

@ObjectType()
export default class Order {
    @Field(type => ID)
    public id: string;

    @Field()
    public time: string;

    @Field(type => Account)
    public account: Account;

    @Field(type => Cart)
    public cart: Cart;
}

@InputType()
export class OrderCreate {
    @Field()
    public time: string;

    @Field(type => ID)
    public account: string;

    @Field(type => ID)
    public cart: string;
}

@InputType()
export class OrderUpdate {
    @Field(type => ID)
    public id: string;

    @Field({ nullable: true })
    public time?: string;

    @Field(type => AccountUpdate, { nullable: true })
    public account?: AccountUpdate;

    @Field(type => CartUpdate, { nullable: true })
    public cart?: CartUpdate;
}

@Resolver(of => Order)
export class OrderResolver implements ResolverInterface<Order> {
    public restToQL(data: RESTOrder): Order {
        return { 
            ...data, 
            account: { id: data.account }, 
            cart: { id: data.cart } 
        } as any
    }

    public qlToREST(order: Order): RESTOrder {
        return {
            ...order,
            account: order.account?.id ? order.account.id : order.account,
            cart: order.cart?.id ? order.cart.id : order.cart
        } as any
    }

    @FieldResolver()
    async account(@Root() order: Order): Promise<Account> {
        return new AccountResolver().account(order.account.id);
    }

    @FieldResolver()
    async cart(@Root() order: Order): Promise<Cart> {
        return new CartResolver().cart(order.cart.id);
    }

    @Query(returns => Order)
    async order(@Arg("id") id: string): Promise<Order> {
        const json = await GET(Endpoint.orders, { id });

        return this.restToQL(json.orders[id] as any);
    }

    @Query(returns => [Order])
    async orders(): Promise<Order[]> {
        const json = await GET(Endpoint.orders);

        return Object.values(json.orders).map((order: any) => this.restToQL(order));
    }

    @Mutation(returns => Order)
    async createOrder(@Arg("input") input: OrderCreate) {
        return this.restToQL(await POST(Endpoint.orders, this.qlToREST(input as any)));
    }

    @Mutation(returns => Order)
    async updateOrder(@Arg("input") input?: OrderUpdate) {
        if (input == null) return null;

        await new AccountResolver().updateAccount(input.account);
        await new CartResolver().updateCart(input.cart);

        return this.restToQL(await PUT(Endpoint.orders, this.qlToREST(input as any)));
    }

    @Mutation(returns => Order)
    async deleteOrder(@Arg("id") id: string) {
        return this.restToQL(await DELETE(Endpoint.orders, id));
    }
}