import { Entity, Column, PrimaryGeneratedColumn, ManyToOne } from 'typeorm';
import { Hotel } from '../hotel/hotel.entity';

@Entity()
export class Booking {
  @PrimaryGeneratedColumn()
  id: number;

  @Column()
  start_date: Date;

  @Column()
  end_date: Date;

  @ManyToOne(() => Hotel, (hotel) => hotel.bookings)
  hotel: Hotel;

  @Column()
  hotel_id: number;

  @Column({ default: false })
  is_checked_in: boolean;

  @Column()
  price: number;
}