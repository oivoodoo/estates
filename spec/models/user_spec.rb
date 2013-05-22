require 'spec_helper'

describe User do
  describe '#role?' do
    describe '#admin' do
      let(:admin) { create(:admin) }

      it 'should be admin' do
        expect(admin.role?(:admin)).to be_true
      end
    end

    context '#user' do
      let(:user) { create(:user) }

      it 'should be normal user' do
        expect(user.role?(:admin)).to be_false
      end
    end
  end
end

describe User do
  context '#admin' do
    let(:admin) { create(:admin) }

    subject { Ability.new(admin) }

    it { should be_able_to(:manage, :all) }
  end
end

