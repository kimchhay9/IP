import { ObjectType, Field, Int } from '@nestjs/graphql';
import { BookingType } from 'src/booking/booking.type';

@ObjectType()
export class HotelType {
  @Field(() => Int)
  id: number;

  @Field()
  name: string;

  @Field()
  address: string;

  @Field()
  phone: string;

  @Field(() => [BookingType], { nullable: true })
  bookings: BookingType[];
}