import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, ResolverInterface } from 'type-graphql';
import Account, { AccountResolver, AccountUpdate } from './account';
import Cart, { CartResolver, CartUpdate } from './cart';
import { DELETE, Endpoint, GET, POST, PUT } from './rest';

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
        const order = json.orders[id] as any;

        return { ...order, account: { id: order.account }, cart: { id: order.cart } };
    }

    @Query(returns => [Order])
    async orders(): Promise<Order[]> {
        const json = await GET(Endpoint.orders);

        return Object.values(json.orders).map((order: any) => ({ ...order, account: { id: order.account }, cart: { id: order.cart } }));
    }

    /**
     * TODO: Implement.
     */
    @Mutation(returns => Order)
    async createOrder(@Arg("input") input: OrderCreate) {
        return await POST(Endpoint.orders, input);
    }

    /**
     * TODO: Implement.
     */
    @Mutation(returns => Order)
    async updateOrder(@Arg("input") input: OrderUpdate) {
        return await PUT(Endpoint.orders, input);
    }

    @Mutation(returns => Order)
    async deleteOrder(@Arg("id") id: string) {
        const order = await this.order(id);

        if (order == undefined) return undefined;

        await DELETE(Endpoint.orders, order.id);

        return order;
    }
}